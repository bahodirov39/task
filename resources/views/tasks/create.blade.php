@extends('layouts.myapp')
@section('content')
    <div class="row">
        <form action="{{ route('task.store') }}" method="POST">
            @csrf
            <div class="col-md-6 mx-auto">
                <h5 class="text-muted">You can add your task here</h5>

                @if(session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }} <b><a href="{{ route('home') }}">Go back</a></b>
                    </div>        
                @endif

                <div class="mb-3"> 
                    <input type="text" class="form-control" name="title" placeholder="Title">
                </div>
                <div class="mb-3">
                    <textarea type="text" class="form-control" name="content" placeholder="Your task"></textarea>
                </div>
                <div class="mb-3"> 
                    <input type="date" class="form-control" name="date">
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </div>
        </form>
    </div>
@endsection