@extends('layouts.admin')



@section('content')

    <h1>Posts</h1>


     <table class="table table-hover table-responsive">
         <thead>
           <tr>
             <th>ID</th>
             <th>User ID</th>
             <th>Category ID</th>
               <th>Photo</th>
               <th>Title</th>
               <th>Comments</th>
               <th>Body</th>
               <th>Created at</th>
               <th>Updated at</th>
           </tr>
         </thead>
         <tbody>
         @if($posts)
             @foreach($posts as $post)
           <tr>
             <td>{{$post->id}}</td>
               <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
             <td>{{$post->category ? $post->category->name : 'No Category'}}</td>
               <td><img height="50px" class="img-rounded" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/60x60'}}" alt=""></td>
               <td><a href="{{route('home.post',$post->slug)}}">{{$post->title}}</a></td>
               <td><a href="{{route('admin.comments.show', $post->id)}}">View comments</a></td>
               <td>{{$post->body}}</td>
               <td>{{$post->created_at->diffForhumans()}}</td>
               <td>{{$post->updated_at->diffForhumans()}}</td>
           </tr>
           @endforeach
           @endif
         </tbody>
       </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}

        </div>
    </div>

    @stop