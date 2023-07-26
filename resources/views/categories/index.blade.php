@extends('app')

@section('content')
<div class="container w-25 border p-4 my-4">
    <div class="row mx-auto">
        <form action="{{ route('categories.store') }}" class="" method="POST">
            @csrf

            @if (session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif

            @error(session('name'))
            <h6 class="alert alert-warning">{{ $message }}</h6>
            @enderror

            <div class="mb-3">
                <label class="form-label">Nombre de la categoria</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Color de la categoria</label>
                <input type="color" name="color" class="form-control">
            </div>
            <div class="pt-3">
                <button class="btn btn-primary" type="submit">Crear nueva categoria</button>
            </div>
        </form>
    </div>
</div>

<div class="container w-25 border p-4 mt-3">

    @foreach ($categories as $category)
    <div class="row py-1">
        <div class="col-md-9 d-flex align-items-center">
            <a class="d-flex align-items-center gap-2" href="{{ route('categories.show', ['category' => $category->id]) }}">

                <div class="mx-4">
                    <span class="color-container mx-4" style="background-color: {{ $category->color }} "></span> {{ $category->name }}
                </div>
            </a>
        </div>

        <div class="col-md-3 d-flex justify-content-end">
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$category->id}}">Eliminar</button>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Al eliminar la categoría <strong>{{ $category->name }}</strong> se eliminan todas las tareas asignadas a la misma.
                    ¿Está seguro que desea eliminar la categoría <strong>{{ $category->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, cancelar</button>
                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-primary">Sí, eliminar categoía</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>


@endsection