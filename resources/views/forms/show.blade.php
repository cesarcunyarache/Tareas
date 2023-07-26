@extends('app')

@section('content')
<div class="container w-25 border p-4 mt-3">
    <form action="{{ route('todos-update', ['id'=> $todo->id] )}}"  class="" method="POST">
    @method('PATCH')    
    @csrf

        @if (session('success'))
        <h6 class="alert alert-success">{{session('success')}}</h6>
        @endif

        @error(session('title'))

        <h6 class="alert alert-warning">{{ $message }}</h6>
        @enderror

        <div>
            <label class="form-label">Titulo de la tarea</label>
            <input type="text" name="title" class="form-control" value="{{$todo->title}}">
        </div>
        <div class="pt-3">
            <button class="btn btn-primary" type="submit">Actualizar tarea</button>
        </div>
    </form>
</div>


@endsection