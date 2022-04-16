@extends('layouts.myapp')
@section('content')
    <div class="row">
        <form action="{{ route('task.update', ['task'=>$data->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-md-6 mx-auto">
                <h5 class="text-muted">You can edit your task here</h5>

                @if(session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }} <b><a href="{{ route('home') }}">Go back</a></b>
                    </div>        
                @endif

                <div class="mb-3"> 
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $data->title }}">
                </div>
                <div class="mb-3">
                    <textarea type="text" class="form-control" name="content" placeholder="Your task">{{ $data->content }}</textarea>
                </div>
                <div class="mb-3"> 
                    <input type="date" class="form-control" name="date" value="{{ $data->required_date }}">
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-success" value="Edit">
                </div>
            </div>
        </form>
    </div>
@endsection