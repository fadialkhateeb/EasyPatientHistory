<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitDiagnosises extends Model
{
    use HasFactory;
    protected $table = 'visit_diagnosis';
    protected $fillable =
    [
    'visit_id',
    'diagn_id'
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnsis::class);
    }


}
