<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Discussion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'views',
        'is_solved',
        'solved_at',
        'best_answer_id',
        'is_pinned',
        'is_locked',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_solved' => 'boolean',
        'is_pinned' => 'boolean',
        'is_locked' => 'boolean',
        'solved_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($discussion) {
            if (empty($discussion->slug)) {
                $discussion->slug = Str::slug($discussion->title) . '-' . Str::random(8);
            }
        });
    }

    /**
     * Get the user that owns the discussion.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tags for the discussion.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the comments for the discussion.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }

    /**
     * Get all comments including replies.
     */
    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the best answer comment.
     */
    public function bestAnswer()
    {
        return $this->belongsTo(Comment::class, 'best_answer_id');
    }

    /**
     * Get the reactions for the discussion.
     */
    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactionable');
    }

    /**
     * Increment the view count.
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Mark the discussion as solved.
     */
    public function markAsSolved(?int $bestAnswerId = null)
    {
        $this->update([
            'is_solved' => true,
            'solved_at' => now(),
            'best_answer_id' => $bestAnswerId,
        ]);

        if ($bestAnswerId) {
            Comment::where('id', $bestAnswerId)->update(['is_best_answer' => true]);
        }
    }

    /**
     * Mark the discussion as unsolved.
     */
    public function markAsUnsolved()
    {
        if ($this->best_answer_id) {
            Comment::where('id', $this->best_answer_id)->update(['is_best_answer' => false]);
        }

        $this->update([
            'is_solved' => false,
            'solved_at' => null,
            'best_answer_id' => null,
        ]);
    }

    /**
     * Get the route key name.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope a query to only include popular discussions.
     */
    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    /**
     * Scope a query to only include solved discussions.
     */
    public function scopeSolved($query)
    {
        return $query->where('is_solved', true);
    }

    /**
     * Scope a query to only include unsolved discussions.
     */
    public function scopeUnsolved($query)
    {
        return $query->where('is_solved', false);
    }

    /**
     * Scope a query to only include pinned discussions.
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }
}
