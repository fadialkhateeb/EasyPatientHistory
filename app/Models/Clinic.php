<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $table = 'clinics';
    protected $primaryKey = 'cli_id';
    protected $fillable =
    [
        'cli_name',
        'cli_address',
        'cli_PhoneNo',
    ];
    /**
     * Get all of the Doctors for the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function DoctorsClinic()
    {
        return $this->hasMany(clinicDoctor::class);
    }
}
