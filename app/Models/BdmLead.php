<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BdmLead extends Model
{
    use HasFactory;

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function developer()
    {
        return $this->hasOne(BdmLeadDeveloper::class, 'bdm_lead_id');
    }

    public function technologies()
    {
        return $this->hasMany(BdmLeadTechnology::class, 'bdm_lead_id');
    }
}
