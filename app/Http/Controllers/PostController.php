<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use RealRashid\SweetAlert\Facades\Alert;

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
                $post->user = Auth::user()->id;
                $post->save();
        // Post::create($this->validateRequest());
        Alert::toast('Successfully added a post ', 'success');


        if (Auth::user()->hasRole(['admin', 'superadmin'])) {
            return redirect()->route('allpost');
        }

        return redirect()->route('welcome');

    }


    public function createStory(){
        return view('createstory');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('Post.show', compact('post'));
    }

    public function View(Post $post)
    {
        // dd($post->id);
        $posts = Post::where('id', '<>', $post->id)->take(10)->get();
        return view('view', compact('post','posts'));
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
        Alert::toast('Successfully updated a post ', 'success');

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
