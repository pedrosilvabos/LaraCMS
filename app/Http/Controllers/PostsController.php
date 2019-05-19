<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'delete']]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Posts::all();

      return view('blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
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
          'post_name' => 'required',
          'post_text' => 'required'
        ]);

        $posts = new Posts([
          'post_name' => $request->get('post_name'),
          'post_text' => $request->get('post_text')
        ]);

        $posts->save();
        return redirect('/')->with('success', 'Post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::find($id);
        return view('blog.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts, $id)
    {
      $request->validate([
        'post_name' => 'required',
        'post_text' => 'required'
      ]);

      $posts = Posts::find($id);
      $posts->post_name = $request->get('post_name');
      $posts->post_text = $request->get('post_text');
      $posts->save();

      return redirect('/posts')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Posts::find($id);
        $posts->delete();

        return redirect('/posts')->with('danger', 'stock has been deleted');
    }

    public function search(Request $request){
       $posts  = Posts::where('post_name', 'like', '%' . $request->get('q') . '%' )->get();
       return view('blog.index', compact('posts'));
    }
}
