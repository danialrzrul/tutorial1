<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request) {
        $postSubmitted = $request->validate([
           'title' => 'required',
           'body' => 'required'
        ]);

        //strip_tags() prevent malicious content into the database
        $postSubmitted['title'] = strip_tags($postSubmitted['title']);
        $postSubmitted['body'] = strip_tags($postSubmitted['body']);
        $postSubmitted['user_id'] = auth()->id(); //ni untuk tau mana satu user yang post particular posting tu
        Post::create($postSubmitted);
        return redirect('/');
    }

    public function editPost(Post $post) {
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request) {
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $postSubmitted = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $postSubmitted['title'] = strip_tags($postSubmitted['title']);
        $postSubmitted['body'] = strip_tags($postSubmitted['body']);

        $post->update($postSubmitted);
        return redirect('/');
    }

    public function deletePost(Post $post) {
        if(auth()->user()->id === $post['user_id']) {
           $post->delete();
        }
        return redirect('/');
    }
}
