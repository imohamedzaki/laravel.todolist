@extends('layouts.master')
@section('content')
    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
        <div class="w-50">
            <h1 class="display-4 text-white">Todo App - Edit page</h1>
            <h5 class="text-white mt-3">Edit your task title</h5>


            <form action="{{ route('todo.update', $todoitem->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="input-group mb-3 w-100 @error('title') errorborder @enderror">
                    <textarea class="form-control form-control-lg text-sm" name="title" cols="20" rows="5"
                        >{{ $todoitem->title }}</textarea>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Update your task</button>
                    </div>
                </div>
                @error('title')
                    <div class="tasknotAdded">
                        {{ $message }}
                    </div>
                @enderror
            </form>

        </div>
    </div>
@endsection
