<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\comments_postID_resources;
use App\Http\Resources\comments_resources;
use App\Models\comment;
use App\Models\post;
use Illuminate\Http\Request;

class comments_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = comment::paginate();
        return new comments_resources($comment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required',
        ]);
        $post = post::find($id);
        $comment = new comment();
        if ($post) {
            $comment->content = $request->get('content');
            $comment->post_id = $request->get('post_id');
            $comment->date_written = now()->format('y-m-d  h:i:s');
            $comment->user_id = 3;
            $comment->save();
            return new comments_postID_resources([$comment]);
        } else {
            return 'no posts';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::find($id);
        $comm = $post->comment;
        return new comments_postID_resources($comm);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
