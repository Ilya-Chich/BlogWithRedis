<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'author'];


    /**
     * @return array
     */
    public function index()
    {
        $posts = $this->posts();
        $dates = $this->dateOfPosts();
        return ['posts' => $posts, 'dateTimeOfPosts' => $dates];
    }

    protected function posts()
    {
        $posts = null;
        $hashedMethod = __CLASS__ . __METHOD__ . hash("sha256", __CLASS__ . __METHOD__);
        $Redis = Redis::connection('6369');
        if (null === ($posts = $Redis->get($hashedMethod))) {
            $posts = DB::table('users')
                ->select(
                    [
                        'posts.id',
                        'name',
                        'title',
                        'description',
                        'posts.created_at',
                        'posts.updated_at',
                        \DB::raw('SUBSTRING(description, 1, 500) as postPreview'),
                        \DB::raw('CHAR_LENGTH(description) as lengthOfPost'),
                    ]
                )
                ->leftjoin('posts', 'users.id', '=', 'posts.author')
                ->orderBy('posts.created_at', 'desc')
                ->get();
            $posts = json_encode($posts);
            $Redis->set($hashedMethod, $posts);
            $Redis->expire($hashedMethod, 360);
        }
        return $posts;
    }


    protected function dateOfPosts()
    {
        $posts = null;
        $hashedMethod = __CLASS__ . __METHOD__ . hash("sha256", __CLASS__ . __METHOD__);
        $Redis = Redis::connection('6379');
        if (null === ($posts = $Redis->get($hashedMethod))) {
            $posts = DB::table('posts')
                ->select([DB::raw('date(created_at) as created_at')])
                ->groupBy(DB::raw('date(created_at)'))
                ->orderBy('created_at', 'desc')
                ->get();
            $posts = json_encode($posts);
            $Redis->set($hashedMethod, $posts);
            $Redis->expire($hashedMethod, 360);
        }
        return $posts;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function createPost(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'bail|required|max:255',
                'description' => 'required',
            ]
        );
        $this->create(
            [
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'author' => Auth::user()->id,
            ]
        );
        return true;
    }

    public function getPost($id)
    {
        $posts = null;
        $hashedMethod = __CLASS__ . __METHOD__ . 'ID:' . (string)$id . hash("sha256", __CLASS__ . __METHOD__);
        $Redis = Redis::connection('6389');
        if (null === ($posts = $Redis->get($hashedMethod))) {
            $posts = $this->find($id);
            $posts = json_encode($posts);
            $Redis->set($hashedMethod, $posts);
            $Redis->expire($hashedMethod, 360);
        }
        return $posts;
    }
}
