<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\posID_resources;
use App\Http\Resources\posts_resources;
use App\Http\Resources\users_resources;
use App\Models\post;
use Illuminate\Http\Request;

class posts_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = post::with(['comment', 'auther', 'category'])->paginate();
        return new posts_resources($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $user = $request->user();

        $post = new post();
        $post->title = $request->get('title');
        $post->content = $request->get('content');

        $post->category_id = intval($request->get('category_id'));
        $post->user_id = 55;
        $post->vote_up = 0;
        $post->vote_down = 0;
        $post->date_written = now()->format('y-m-d h:i:s');
        $post->save();
        return new posts_resources([$post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::with(['comment', 'auther', 'category'])->where('id', $id)->get();
        if ($post) {
            return new posID_resources($post);
        } else {
            return 'no posts';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post = post::find($id);
        if ($request->has('title')) {
            $post->title = $request->get('title');
        }
        if ($request->has('content')) {
            $post->content = $request->get('content');
        }
        if ($request->has('category_id')) {
            $post->category_id = $request->get('ategory_id');
        }


        $post->save();
        return new posts_resources([$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);
        $post->delete();
        if ($post) {
            return new posts_resources([$post]);
        } else {
            return 'deleted';
        }
    }

    public function votes(Request $requst, $id)
    {

        return $requst->user($id);
        // $requst->validate([

        // 'vote' => 'required'
        // ]);

        // $post = post::find($id);

        // if ($requst->get('vote') == 'up') {

        // $post->vote_up += 1;
        // }

        // if ($requst->get('vote') == 'down') {
        // $post->vote_down += 1;
        // }

        // $post->save();
        // return new posts_resources($post);
    }
}
