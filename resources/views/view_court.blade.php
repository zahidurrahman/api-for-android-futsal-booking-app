@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="/home" class="btn btn-primary"><i class="fas fa-arrow-left" style="margin-right: 10px"></i>Dashboard</a>


                    </div>

                    <div class="card-body">


                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    <!-- Button trigger modal -->
                        <button type="button" style="margin-bottom: 10px" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                            Add New Court
                        </button>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Court name</th>
                                <th scope="col">Court Location</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                               $i=1;
                               $shares = DB::table('courts')->get();

                            ?>
                            @foreach($shares as $share)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$share->name}}</td>
                                    <td>{{$share->location}}</td>

                                    <td>
                                        <form action="{{ route('destroy_court',$share->id) }}" method="POST">
                                            <a class="btn btn-outline-info btn-sm" href="/edit_court?id={{$share->id}}">Edit</a>

                                            @csrf

                                              <input type="hidden" name="id" value="{{$share->id}}"/>
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                                <?php $i++;?>
                            @endforeach


                            </tbody>

                        </table>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Court</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('add_court') }}" enctype ='multipart/form-data'>
                                        @csrf

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="court_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Location</label>
                                            <input type="text" name="location" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image Url</label>
                                            <input type="url" name="url" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required>
                                        </div>

                                        <button type="submit" class="btn btn-success">ADD</button>
                                    </form>

                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                </div>
            </div>
        </div>
    </div>
@endsection
