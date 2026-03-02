<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'latest');
        $tag = $request->get('tag');
        $search = $request->get('search');

        $discussions = Discussion::with(['user', 'tags', 'reactions'])
            ->withCount(['allComments']);

        // Apply filters
        if ($tag) {
            $discussions->whereHas('tags', function ($query) use ($tag) {
                $query->where('slug', $tag);
            });
        }

        if ($search) {
            $discussions->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        switch ($filter) {
            case 'popular':
                $discussions->popular();
                break;
            case 'solved':
                $discussions->solved()->latest();
                break;
            case 'unsolved':
                $discussions->unsolved()->latest();
                break;
            default:
                $discussions->latest();
                break;
        }

        $discussions = $discussions->paginate(15);

        // Get popular tags
        $popularTags = Tag::withCount('discussions')
            ->orderBy('discussions_count', 'desc')
            ->limit(10)
            ->get();

        return view('home', compact('discussions', 'popularTags', 'filter', 'tag', 'search'));
    }
}
