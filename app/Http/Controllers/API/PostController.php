<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index() {

        $posts = Post::orderBy('publish_date', 'desc')
                        ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Paginated list of Posts',
            'data' => [
                'posts' => $posts
            ]
        ], 200);
    }

}
