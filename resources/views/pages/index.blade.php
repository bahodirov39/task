@extends('layouts.myapp')
@section('content')

    <div class="row mt-5">
        <div class="col-md-10 mx-auto">
            <a href="{{ route('task.create') }}">Create a task</a>
            <h4>All tasks</h4>
            <p>Done tasks are marked with <span class="text-success"><b>Green</b></span> color.</p>
            @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('message') }}</b>
                </div>        
            @endif
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Required date</th>
                  </tr>
                </thead>
                <tbody>
                @php $i = 1; @endphp
                @foreach ($data as $item)
                @if ($item->status == 'done')
                <tr>
                    <th class="bg-success text-white" scope="row">{{ $i++ }}</th>
                    <td class="bg-success text-white"> {{ $item->name }} </td>
                    <td class="bg-success text-white"> <a class="text-white" href="{{ route('task.show', ['task'=>$item->id]) }}"> {{ $item->title }} </a> </td>
                    <td class="bg-success text-white">{{ $item->required_date }}</td>
                </tr>
                @else
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td> {{ $item->name }} </td>
                    <td> <a href="{{ route('task.show', ['task'=>$item->id]) }}"> {{ $item->title }} </a> </td>
                    <td>{{ $item->required_date }}</td>
                </tr>
                @endif
                @endforeach
                </tbody>
              </table>
            {{ $data->links() }}
        </div>
    </div>
@endsection