<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'Appointments';
    protected $primaryKey = 'appoint_id';
    protected $fillable =
    [
        'time',
        'description',
        'recep_id',
        'pat_id',
    ];


    public function reception()
    {
        return $this->belongsTo(Receptionist::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }


}
