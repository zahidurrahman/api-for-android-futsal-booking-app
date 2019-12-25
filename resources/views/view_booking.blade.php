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

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Court ID</th>
                                <th scope="col">Time</th>
                                <th scope="col">Date</th>
                                <th scope="col">Share Court</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            $shares = DB::table('court_books')->get();

                            ?>
                            @foreach($shares as $share)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$share->id}}</td>
                                    <td>{{$share->user_id}}</td>
                                    <td>{{$share->court_id}}</td>
                                    <td>{{$share->time_slot}}</td>
                                    <td>{{$share->the_date}}</td>
                                    <td>{{$share->share_court}}</td>

                                    <td>
                                        <form action="{{ route('destroy_booking',$share->id) }}" method="POST">

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
                </div>
            </div>
        </div>
    </div>
@endsection
