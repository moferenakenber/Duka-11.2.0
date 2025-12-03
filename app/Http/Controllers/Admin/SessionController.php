<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class SessionController extends Controller
{
    /**
     * List all active sessions
     */
    public function index()
    {
        $sessions = DB::table('sessions')->get()->map(function ($session) {
            return [
                'id' => $session->id,
                'user_id' => $session->user_id,
                'username' => $session->user_id ? optional(DB::table('users')->find($session->user_id))->name : 'Visitor',
                'email' => $session->user_id ? optional(DB::table('users')->find($session->user_id))->email : null,
                'ip_address' => $session->ip_address,
                'remember_me' => $session->payload && $this->payloadHasRememberMe($session->payload),
                'last_activity' => date('Y-m-d H:i:s', $session->last_activity),
                'expires_at' => date('Y-m-d H:i:s', $session->last_activity + (config('session.lifetime') * 60)),
            ];
        });

        return view('admin.sessions.index', compact('sessions'));
    }

    /**
     * Force logout a session
     */
    public function destroy($id)
    {
        DB::table('sessions')->where('id', $id)->delete();

        return redirect()->route('admin.sessions.index')->with('success', 'Session has been terminated.');
    }

    /**
     * Check if the session payload has "remember me" token
     */
    private function payloadHasRememberMe($payload)
    {
        $data = unserialize(base64_decode($payload));
        return isset($data['login_web_remember']); // Laravel uses this key internally
    }
}
