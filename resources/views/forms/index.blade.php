@extends('app')

@section('content')
<div class="container w-25 border p-4 mt-3">
    <form action="{{ route('todos') }}" class="" method="POST">
        @csrf

        @if (session('success'))
        <h6 class="alert alert-success">{{session('success')}}</h6>
        @endif

        @error(session('title'))

        <h6 class="alert alert-warning">{{ $message }}</h6>
        @enderror

        <div>
            <label class="form-label">Titulo de la tarea</label>
            <input type="text" name="title" class="form-control">
        </div>
        <label for="category_id" class="form-label">Categoria de la tarea</label>
        <select name="category_id" class="form-select">
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <div class="pt-3">
            <button class="btn btn-primary" type="submit">Crear nueva tarea</button>
        </div>
    </form>



</div>

<div class="container w-25 border p-4 mt-3">

    @foreach ($todos as $todo )
    <div class="row py-1">
        <div class="col-md-9 d-flex align-items-center">
            <a href="{{ route('todos-edit', ['id' => $todo->id]) }}">{{ $todo->title }}</a>
        </div>

        <div class="col-md-3 d-flex justify-content-end">
            <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </div>
    </div>
    @endforeach
</div>


@endsection