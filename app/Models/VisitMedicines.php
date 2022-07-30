<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitMedicines extends Model
{
    use HasFactory;
    protected $table = 'visit_medicines';
    protected $fillable =
    [
        'note',
        'visit_id',
        'medic_id'
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

}
