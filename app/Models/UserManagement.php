<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserManagement extends Model
{
    protected $table = 'user_management';
    protected $fillable = ['id','user_id','permissions','login_history','status','payroll_id','payment_history_id','created_at','updated_at'];

    public function userId()
    {
        return $this->belongsTo(App\Models\Users::class);
    }
    public function payrollId()
    {
        return $this->belongsTo(App\Models\Payroll::class);
    }
    public function paymentHistoryId()
    {
        return $this->belongsTo(App\Models\PaymentHistory::class);
    }}
