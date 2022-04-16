@extends('layouts.myapp')
@section('content')

    <div class="row mt-5">
        <div class="col-md-10 mx-auto">
            @if (count($data) == 0)
                <span>No tasks yet!</span> 
            @endif
            <a href="{{ route('task.create') }}">Create a task</a>
            <h4>Notification</h4>
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
                    <th scope="col">Title</th>
                    <th scope="col">Required date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @php $i = 1; @endphp
                @foreach ($data as $item)
                @if ($item->status == 'done')
                <tr>
                    <th class="bg-success text-white" scope="row">{{ $i++ }}</th>
                    <td class="bg-success text-white"> <a class="text-white" href="{{ route('task.show', ['task'=>$item->id]) }}"> {{ $item->title }} </a> </td>
                    <td class="bg-success text-white">{{ $item->required_date }}</td>
                    <td class="bg-success text-white">
                        <div>   
                            <form action="{{ route('undone', ['task'=>$item->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-light btn-sm" title="undone"><i class="bi bi-patch-check-fill text-success"></i></button>
                            </form>
                            <a href="{{ route('task.edit', ['task'=>$item->id]) }}" class="d-inline">
                                <button type="submit" class="btn btn-primary btn-sm" title="edit"><i class="bi bi-pencil"></i></button>
                            </a>
                            <form action="{{ route('task.destroy', ['task'=>$item->id]) }}" method="POST" class="d-inline"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="delete"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @else
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td> <a href="{{ route('task.show', ['task'=>$item->id]) }}"> {{ $item->title }} </a> </td>
                    <td>{{ $item->required_date }}</td>
                    <td>
                        <div>   
                            <form action="{{ route('done', ['task'=>$item->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm" title="done"><i class="bi bi-patch-check-fill"></i></button>
                            </form>
                            <a href="{{ route('task.edit', ['task'=>$item->id]) }}" class="d-inline">
                                <button type="submit" class="btn btn-primary btn-sm" title="edit"><i class="bi bi-pencil"></i></button>
                            </a>
                            <form action="{{ route('task.destroy', ['task'=>$item->id]) }}" method="POST" class="d-inline"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="delete"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
                </tbody>
              </table>
              {{ $data->links() }}
        </div>
    </div>
@endsection