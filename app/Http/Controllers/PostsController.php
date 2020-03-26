<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class PostsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PostsController extends Controller
{
    /**
     * @var PostService
     */
    protected $postService;

    /**
     * PostsController constructor.
     *
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function listPost()
    {
        $data = $this->postService->listPost();
        if($data['status'] == false) return $this->responseFail(Response::HTTP_BAD_REQUEST);
        return $this->responseSuccess($data['posts']);
    }

    public function postsOfUser()
    {
        $data = $this->postService->postsOfUser();
        if($data['status'] == false) return $this->responseFail(Response::HTTP_BAD_REQUEST);
        return $this->responseSuccess($data['posts']);
    }

    public function createPost(Request $request)
    {
        $data = $this->postService->createPost($request);
        if($data['status'] == false) return $this->responseFail(Response::HTTP_BAD_REQUEST);
        return $this->responseSuccess($data['post']);
    }

    public function updatePost(Request $request)
    {
        $data = $this->postService->updatePost($request);
        if($data['status'] == false) return $this->responseFail(Response::HTTP_BAD_REQUEST);
        return $this->responseSuccess($data['post']);
    }

    public function deletePost(Request $request)
    {
        $data = $this->postService->deletePost($request);
        if($data['status'] == false) return $this->responseFail(Response::HTTP_BAD_REQUEST);
        return $this->responseSuccess();
    }
}
