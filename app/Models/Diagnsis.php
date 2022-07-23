<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnsis extends Model
{
    use HasFactory;
    protected $table = 'diagnosises';
    protected $primaryKey = 'diagn_id';
    protected $fillable =
    [
        'diagn_name'
    ];
}
