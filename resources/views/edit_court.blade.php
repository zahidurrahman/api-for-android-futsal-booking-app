@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="/show_court" class="btn btn-primary"><i class="fas fa-arrow-left" style="margin-right: 10px"></i>Back</a>


                    </div>

                    <div class="card-body">


                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                    @endif
                             <?php
                                $id=$_GET['id'];
                            $shares = DB::table('courts')->where('id',$id)->first();
                             ?>
                            <form method="POST" action="{{ route('update_court') }}" enctype ='multipart/form-data'>
                                @csrf
                                    <input type="hidden" name="id" value="{{$id}}"/>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="court_name" class="form-control" value="{{$shares->name}}" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location</label>
                                    <input type="text" name="location" class="form-control" value="{{$shares->location}}"  id="exampleInputEmail1" aria-describedby="emailHelp"  required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image Url</label>
                                    <input type="url" name="url" class="form-control" value="{{$shares->image}}"  id="exampleInputEmail1" aria-describedby="emailHelp"  required>
                                </div>

                                <button type="submit" class="btn btn-success">Update</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
