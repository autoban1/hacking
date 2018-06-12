@extends('layouts.admin')




@section('content')


    <h1>Media</h1>



    @if($photos)
     <table class="table table-hover">
         <thead>
           <tr>
             <th>ID</th>
             <th>Name</th>
             <th>Created at</th>
           </tr>
         </thead>
         <tbody>

         @foreach($photos as $photo)
           <tr>
             <td>{{$photo->id}}</td>
             <td><img src="{{$photo->file}}" height="70px" class="img-rounded" alt=""></td>
             <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
               <td>

                   {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}
                   <div class="form-group">
                       {!! Form::submit('Delete Photo', ['class'=>'btn btn-danger']) !!}
                                  </div>
                                  {!! Form::close() !!}
               </td>
           </tr>
@endforeach
       </table>
@endif

    @stop