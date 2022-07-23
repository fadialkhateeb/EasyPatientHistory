<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    protected $table = 'specialties';
    protected $primaryKey = 'Spec_id';
    protected $fillable =
    [
        'spec_name'

    ];
    /**
     * Get the uDoctorser associated with the Specialty
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
