<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Carbon\Carbon;

class User extends \TCG\Voyager\Models\User
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function leads()
    {
        $dt = Carbon::now();
        return $this->hasMany(Lead::class, 'added_by')->where('created_at', '>', $dt->startOfDay());
    }

    public function totalBdmLeads()
    {
        return $this->hasMany(BdmLead::class, 'user_id');
    }

    public function prospectBdmLeads()
    {
        return $this->hasMany(BdmLead::class, 'user_id')->where('status', 0);
    }

    public function warmLeadBdmLeads()
    {
        return $this->hasMany(BdmLead::class, 'user_id')->where('status', 1);
    }

    public function rejectedBdmLeads()
    {
        return $this->hasMany(BdmLead::class, 'user_id')->where('status', 4);
    }

    public function rolex()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
