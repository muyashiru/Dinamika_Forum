<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Toggle reaction on a reactionable model.
     */
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'reactionable_type' => 'required|in:App\Models\Discussion,App\Models\Comment',
            'reactionable_id' => 'required|integer',
            'type' => 'required|in:like,upvote,downvote',
        ]);

        $reaction = Reaction::where([
            'user_id' => Auth::id(),
            'reactionable_type' => $validated['reactionable_type'],
            'reactionable_id' => $validated['reactionable_id'],
        ])->first();

        if ($reaction) {
            if ($reaction->type === $validated['type']) {
                // Same type, remove reaction
                $reaction->delete();
                $action = 'removed';
            } else {
                // Different type, update reaction
                $reaction->update(['type' => $validated['type']]);
                $action = 'updated';
            }
        } else {
            // Create new reaction
            Reaction::create([
                'user_id' => Auth::id(),
                'reactionable_type' => $validated['reactionable_type'],
                'reactionable_id' => $validated['reactionable_id'],
                'type' => $validated['type'],
            ]);
            $action = 'added';
        }

        // Get updated counts
        $reactionable = $validated['reactionable_type']::find($validated['reactionable_id']);
        $counts = [
            'like' => $reactionable->reactions()->where('type', 'like')->count(),
            'upvote' => $reactionable->reactions()->where('type', 'upvote')->count(),
            'downvote' => $reactionable->reactions()->where('type', 'downvote')->count(),
        ];

        return response()->json([
            'success' => true,
            'action' => $action,
            'counts' => $counts,
        ]);
    }
}
