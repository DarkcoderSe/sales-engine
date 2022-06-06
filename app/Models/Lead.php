<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Lead extends Model
{
    use HasFactory;

    public $export_handler = \App\Exports\Lead::class;
    protected $perPage = 100;
    public $allow_export_all = true;

    public function today()
    {
        $date = Carbon::now()->startOfDay();
        return Lead::where('created_at', '>', $date)->get();
    }
}
