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
    'time',
    'description',
	'pat_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
