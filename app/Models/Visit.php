<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $table = 'visits';
    protected $primaryKey = 'visit_id';
    protected $fillable =
    [
    'visit_time',
    'Description',
	'pat_id',
    'doc_id',
	'recep_id'
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function reception()
    {
        return $this->belongsTo(Receptionist::class);
    }

}
