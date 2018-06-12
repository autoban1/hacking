<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {


        $input = $request->all();
//logged in user
        $user = Auth::user();
//da li imamo fajl
        if($file = $request->file('photo_id')){
//pravimo ime, vreme + orignal ime
            $name = time(). $file->getClientOriginalName();
//prebacimo fajl u images folder
            $file->move('images',$name);
//pravimo sliku u bazi
            $photo = Photo::create(['file'=>$name]);
//u polje za post ubacujemo id iz PHOTO
            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);



        return redirect('/admin/posts');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $post = Post::findOrFail($id);

        $categories = Category::pluck('name','id')->all();

        return view('admin.posts.edit',compact('post','categories'));
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
       $input = $request->all();

        if($file = $request->file('photo_id')){
//pravimo ime, vreme + orignal ime
            $name = time(). $file->getClientOriginalName();
//prebacimo fajl u images folder
            $file->move('images',$name);
//pravimo sliku u bazi
            $photo = Photo::create(['file'=>$name]);
//u polje za post ubacujemo id iz PHOTO
            $input['photo_id'] = $photo->id;
        }

        Auth::user()->posts()->whereId($id)->first()->update($input);

        return redirect('/admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);


        $post->photo ? unlink(public_path() . $post->photo->file) : ' ' ;

        $post->delete();

        return redirect('/admin/posts');
    }

    public function post($slug){

//        $categories = Category::all();
//
//        $post = Post::findOrFail($id);
//
//        return view('post',compact('post','categories'));

        $post = Post::findBySlugOrFail($slug);

        $categories = Category::all();

        $comments = $post->comments()->whereIsActive(1)->get();

        return view('post',compact('post','comments','categories'));


    }




}
