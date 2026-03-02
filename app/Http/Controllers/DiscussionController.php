<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('verified')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('discussions.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $discussion = Discussion::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        if (isset($validated['tags'])) {
            $discussion->tags()->attach($validated['tags']);
        }

        return redirect()
            ->route('discussions.show', $discussion)
            ->with('success', 'Diskusi berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discussion $discussion)
    {
        $discussion->incrementViews();

        $discussion->load([
            'user',
            'tags',
            'comments.user',
            'comments.replies.user',
            'comments.reactions',
            'reactions',
            'bestAnswer'
        ]);

        return view('discussions.show', compact('discussion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discussion $discussion)
    {
        $this->authorize('update', $discussion);

        $tags = Tag::orderBy('name')->get();
        return view('discussions.edit', compact('discussion', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discussion $discussion)
    {
        $this->authorize('update', $discussion);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $discussion->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        if (isset($validated['tags'])) {
            $discussion->tags()->sync($validated['tags']);
        } else {
            $discussion->tags()->detach();
        }

        return redirect()
            ->route('discussions.show', $discussion)
            ->with('success', 'Diskusi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        $this->authorize('delete', $discussion);

        $discussion->delete();

        return redirect()
            ->route('home')
            ->with('success', 'Diskusi berhasil dihapus!');
    }

    /**
     * Set best answer for discussion.
     */
    public function setBestAnswer(Discussion $discussion, Comment $comment)
    {
        $this->authorize('update', $discussion);

        if ($comment->discussion_id !== $discussion->id) {
            abort(403, 'Comment tidak termasuk dalam diskusi ini.');
        }

        $discussion->markAsSolved($comment->id);

        return back()->with('success', 'Best answer berhasil ditandai!');
    }

    /**
     * Remove best answer from discussion.
     */
    public function removeBestAnswer(Discussion $discussion)
    {
        $this->authorize('update', $discussion);

        $discussion->markAsUnsolved();

        return back()->with('success', 'Best answer berhasil dihapus!');
    }

    /**
     * Toggle solved status.
     */
    public function toggleSolved(Discussion $discussion)
    {
        $this->authorize('update', $discussion);

        if ($discussion->is_solved) {
            $discussion->markAsUnsolved();
            $message = 'Diskusi ditandai sebagai belum selesai.';
        } else {
            $discussion->markAsSolved();
            $message = 'Diskusi ditandai sebagai selesai.';
        }

        return back()->with('success', $message);
    }
}
