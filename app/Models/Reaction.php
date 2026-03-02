<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'reactionable_id',
        'reactionable_type',
        'type',
    ];

    /**
     * Get the user that owns the reaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent reactionable model.
     */
    public function reactionable()
    {
        return $this->morphTo();
    }
}
