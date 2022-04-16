@extends('layouts.myapp')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto mt-5 shadow p-3">
            <h3>{{ $data->title }}</h3>
            <hr>
            <p>{{ $data->content }}</p>
            <hr>
            <span>Required date: <span class="badge bg-primary">{{ $data->required_date }}</span></span>
            <br>
             @if ($data->status == 'done')
                <span>Status: <span class="badge bg-success">{{ $data->status }}</span></span>
             @else
                <span>Status: <span class="badge bg-light border text-dark">{{ $data->status }}</span></span>
             @endif
             <br>
            <span>Created at: <u>{{ date('Y-m-d H:i', strtotime($data->created_at)) }}</u></span>
        </div>
    </div>
@endsection