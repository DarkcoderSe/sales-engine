<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BdmLeadTechnology extends Model
{
    use HasFactory;

    public function technology()
    {
        return $this->belongsTo(Technology::class, 'technology_id');
    }
}
