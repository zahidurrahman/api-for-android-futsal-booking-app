@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border: 0;">
                    <div class="card-header" style="background-color:#a8e063;border: 0;color:#2C3E50;">
                        Dashboard
                        {{--<span style="float: right"><a href="/create-assesment">Add new Assesment</a></span>--}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <br>
                        <div class="row">
                            <div class="col">
                                <a href="/show_court" style="text-decoration: none">
                                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">

                                        <div class="card-body">
                                            <center>
                                                <h2 class="card-title">
                                                    <img src="https://image.flaticon.com/icons/svg/2070/2070937.svg" style="width:50px;height:50px;">
                                                </h2>
                                                <p>Manage Court</p>
                                            </center>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="/view_booking" style="text-decoration: none;">
                                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <center>
                                                <h2 class="card-title">
                                                    <img src="https://image.flaticon.com/icons/svg/321/321774.svg" style="width:50px;height:50px;">
                                                </h2>
                                                <p>View Booking</p>
                                            </center>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="#" style="text-decoration: none">
                                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">

                                        <div class="card-body">
                                            <center>
                                                <h2 class="card-title">
                                                    <img src="https://cdn.pixabay.com/photo/2017/10/16/12/30/coming-soon-2857144_960_720.png" style="width:50px;height:50px;">
                                                </h2>
                                                <p>Coming Soon</p>
                                            </center>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="#" style="text-decoration: none;">
                                    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <center>
                                                <h2 class="card-title">
                                                    <img src="https://cdn.pixabay.com/photo/2017/10/16/12/30/coming-soon-2857144_960_720.png" style="width:50px;height:50px;">
                                                </h2>
                                                <p>Coming Soon</p>
                                            </center>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer" style="background-color:#a8e063;border: 0;height: 1px;">

                    </div>
                </div>
            </div>

        </div>
@endsection
