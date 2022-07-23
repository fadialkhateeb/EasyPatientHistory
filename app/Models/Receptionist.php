<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'receptionists';
    protected $primaryKey = 'recep_id';
    protected $fillable =
    [
        'Qualification',
        'user_id'
    ];

    /**
     * Get the user that owns the Receptionist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
