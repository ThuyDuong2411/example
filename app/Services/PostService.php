<?php


namespace App\Services;

use App\Repositories\PostRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function listPost()
    {
        $posts = $this->postRepository->all();
        return array('status' => true, 'posts' => $posts);
    }

    public function postsOfUser()
    {
        $posts = $this->postRepository->findByField('user_id', Auth::user()->id);
        return array('status' => true, 'posts' => $posts);
    }

    public function createPost(Request $request)
    {
        $titlePost = isset($request['titlePost']) ? $request['titlePost'] : '';
        $contentPost = isset($request['contentPost']) ? $request['contentPost'] : '';
        $post = $this->postRepository->create([
            'title' => $titlePost,
            'content' => $contentPost,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return array('status' => true, 'post' => $post);
    }

    public function updatePost(Request $request)
    {
        $post = $this->postRepository->find($request->post_id);
        $titlePost = isset($request['titlePost']) ? $request['titlePost'] : $post->title;
        $contentPost = isset($request['contentPost']) ? $request['contentPost'] : $post->content;
        $post = $this->postRepository->update([
            'title' => $titlePost,
            'content' => $contentPost,
        ], $request->post_id);
        return array('status' => true, 'post' => $post);
    }

    public function deletePost(Request $request)
    {
        $this->postRepository->delete($request->post_id);
        return array('status' => true);
    }
}
