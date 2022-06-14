<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewInvite extends Model
{
    use HasFactory;

    public function lead()
    {
        return $this->belongsTo(BdmLead::class, 'bdm_lead_id');
    }

    public function bdm()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }
}
