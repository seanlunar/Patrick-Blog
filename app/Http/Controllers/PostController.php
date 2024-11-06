<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carbon::now();
        $posts = Post::all();
        return view('Post.index', compact('posts'));
    }

    public function indexone()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('welcome', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();

            if($request->hasFile('image')){
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5048',
                ]);
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $post->image = $imageName;
            }

                $post->title = $request->title;
                $post->body = $request->body;
                $post->save();
        // Post::create($this->validateRequest());
        return redirect()->route('allpost');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('Post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('Post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // return $post;
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5048',
            ]);
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        $post ->title = $request->title;
        $post ->body = $request->body;
        $post->save();
        // $post->update($this->validateRequest());

        return to_route('showpost', $post->slug);
        // return $post->update($this->validateRequest());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('allpost');
    }


    private function validateRequest(){
        return request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
    }
}
