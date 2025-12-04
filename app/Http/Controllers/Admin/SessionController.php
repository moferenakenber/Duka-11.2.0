<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class SessionController extends Controller
{
    /**
     * List all active sessions
     */
    public function index()
    {
        $currentSessionId = session()->getId();
        $sessionRow = DB::table('sessions')->where('id', $currentSessionId)->first();
        Log::info('Current session row', ['session_id' => $currentSessionId, 'row' => $sessionRow]);

        $sessions = DB::table('sessions')->orderBy('last_activity', 'desc')->get();

        $sessions = $sessions->map(function ($session) {
            $user = $session->user_id ? User::find($session->user_id) : null;

            $payload = @unserialize(base64_decode($session->payload)) ?: [];
            $rememberMe = $payload['remember_me'] ?? false;


            Log::info('Session row', [
                'session_id' => $session->id,
                'user_id' => $session->user_id,
                'remember_from_db' => $session->remember_me,
                'payload_keys' => array_keys($payload),
            ]);

            $lastActivity = (int) $session->last_activity;

            $sessionLifetime = (int) config('session.lifetime');
            $expiresAt = now()->createFromTimestamp($lastActivity)->setTimezone(config('app.timezone'))
                ->addMinutes($rememberMe ? 3 * 24 * 60 : $sessionLifetime);




            return (object) [
                'id' => $session->id,
                'user' => $user,
                'email' => $user?->email,
                'ip_address' => $session->ip_address,
                'remember_me' => $rememberMe,
                'expires_at' => $expiresAt->toDateTimeString(),
            ];
        });


        return view('admin.sessions.index', compact('sessions'));
    }

    /**
     * Force logout (delete session)
     */
    public function destroy($id)
    {
        // Delete the session row
        DB::table('sessions')->where('id', $id)->delete();

        // If the session being deleted is the current user's, also log them out
        if (session()->getId() === $id) {
            auth()->logout();
            session()->invalidate();
            session()->regenerateToken();
        }

        return back()->with('success', 'Session deleted and user will be logged out.');
    }

}
