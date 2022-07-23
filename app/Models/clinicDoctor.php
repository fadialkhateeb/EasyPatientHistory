<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clinicDoctor extends Model
{
    use HasFactory;
    protected $table = 'doctor_clinic';
    protected $fillable =
    [
        'work_hours',
        'clinic_id',
        'doc_id'
    ];

    /**
     * Get the clinic associated with the clinicDoctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clinic()
    {
        return $this->belongsTo(Doctor::class,'clinic_id');
    }

    public function doctor()
    {
        return $this->belongsTo(clinic::class,'doc_id');
    }


}
