<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all(); 
          /*here init conncet with DB to bring all feilds by get()*/
        return view('posts.index',compact('posts'));
        /*after bring data then view in browser and bring name of table    }*/
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  $this->validatePost();
     Post::create([//insert use array
            'title'=>request('title'),//requst to bring data into by user
            'body'=>request('body'),
            'author'=>request('author'),
        
        ]);
       return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      //  $comments = Comment::all();
      $comments = $post->comments()->where('approved', 1)->get();
      return view('posts.show', compact(['post', 'comments']));
      //  return view('posts.show',compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Post $post)
    {
    return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    { $this->validatePost();
        $post->update([
            'title'=>request('title'),
            'body'=>request('body'),
            'author'=>request('author')
        ]);
        return redirect('/posts/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
    }
    public function validatePost()
    {

        request()->validate([
            'title'=>['required','unique:posts','max:100'],
            'body'=> 'required',
            'author'=>'required'
        ]);
    }
}
