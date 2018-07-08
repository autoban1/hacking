@extends('layouts.admin')




@section('content')


    <h1>Media</h1>



    @if($photos)

        <form action="/admin/delete/media" method="post">

            {{csrf_field()}}

            {{method_field('delete')}}
            <div class="form-group col-sm-2">
                <select name="checkBoxArray" id="" class="form-control">
                    <option value=""> Delete </option>
            </div>
            <div class="form-group col-sm-2">
                <input type="submit" name="delete_all" class="btn btn-primary">
            </div>
            

        
     <table class="table table-hover">
         <thead>
           <tr>
               <th><input type="checkBox" id="options"></th>
             <th>ID</th>
             <th>Name</th>
             <th>Created at</th>
           </tr>
         </thead>
         <tbody>

         @foreach($photos as $photo)
           <tr>
               <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
             <td>{{$photo->id}}</td>
             <td><img src="{{$photo->file}}" height="70px" class="img-rounded" alt=""></td>
             <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
               <td>

                  {{--<div class="form-group">--}}
                      {{--<input type="hidden" name="photo" value="{{$photo->id}}">--}}
                      {{--<input type="submit" name="delete_single" value="Delete" class="btn btn-danger">--}}

                  {{--</div>--}}
               </td>
           </tr>
@endforeach
       </table>
        </form>
@endif








    @stop

@section('scripts')

    <script>

        $(document).ready(function ()
        {

                        $('#options').click(function ()
                        {

                                            if(this.checked)
                                            {

                                                $('.checkBoxes').each(function ()
                                                {

                                                    this.checked = true;

                                                });

                                            } else {

                                                $('.checkBoxes').each(function () {
                                                    this.checked = false;

                                                });

                                            }

                            });

        });


    </script>
    
    
    @stop