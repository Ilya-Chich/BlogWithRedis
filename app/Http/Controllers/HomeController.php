<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends IndexController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(): object
    {
        $dataset = $this->postModel->index();
        $dataset['posts'] = json_decode($dataset['posts']);
        return response()->view('home', ['dataset' => $dataset]);
    }

    public function getPostForm()
    {
        return response()->view('post/post_form');
    }

    public function createPost(Request $request)
    {
        $this->postModel->createPost($request);
        return redirect()->route('home')->with('success', 'Post has been successfully added!');
    }

    public function getPost($id)
    {
        $post = json_decode($this->postModel->getPost($id));
        return response()->view('post/post_detail', ['post' => $post]);
    }

    public function editPost($id)
    {
        $post = json_decode($this->postModel->getPost($id));
        return response()->view('post/post_edit', ['post' => $post]);
    }

    public function updatePost(Request $request, $id)
    {
        $post = new Post(json_decode($this->postModel->getPost($id), true));
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return redirect()->route('home')->with('success', 'Post has been updated successfully!');
    }

    public function deletePost($id)
    {
        $post = new Post(json_decode($this->postModel->getPost($id), true));
        $post->exists = true;
        $post->delete();
        return redirect()->route('home')->with('success', 'Post has been deleted successfully!');
    }
}
