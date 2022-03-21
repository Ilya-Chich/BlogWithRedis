<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(): object
    {
        $dataset = $this->postModel->index();
        foreach ($dataset as $item => $data) {
            $dataset[$item] = json_decode($data);
        }
        return (!empty($dataset['posts']))
            ? response()->view('post.index', ['dataset' => $dataset])
            : response()->view('errors.404', [], 404);
    }

    public function getPost($id)
    {
        $post = $this->postModel->getPost($id);
        $post = json_decode($post);
        return isset($post)
            ? response()->view('post/post_show', ['post' => $post])
            : response()->view('errors.404', [], 404);
    }

    protected function paginate(array &$dataset, string $paramToPaginate, int $perPage = 5): void
    {
        $dataset[$paramToPaginate] = $dataset[$paramToPaginate]->paginate($perPage);
    }
}
