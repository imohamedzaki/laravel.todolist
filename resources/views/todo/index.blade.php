@extends('layouts.master')
@section('content')
    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
        <div class="w-50">
            <h1 class="display-4 text-white">Todo App</h1>
            <h5 class="text-white mt-3">Add some task so you can manage them</h5>

            <form action="{{ route('todo.store') }}" method="POST">
                @csrf
                <div class="input-group mb-3 w-100 @error('title') errorborder @enderror">
                    <input type="text" class="form-control form-control-lg " name="title" placeholder="Enter your task">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Add to the list</button>
                    </div>
                </div>
                @error('title')
                    <div class="tasknotAdded">
                        {{ $message }}
                    </div>
                @enderror
            </form>
            @if (session('taskAdded'))
                <p class="taskAdded">{{ session('taskAdded') }}</p>
            @endif
            @if ($listOfTasks->count() > 0)
                <h4 class="text-white mt-4">Your tasks menu</h4>
                @foreach ($listOfTasks as $task)
                    <div class="bg-white w-100 p-3 mb-1 taskdiv">
                        <div class="taskdiv_left">
                            @if ($task->completed == 0)
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right"
                                    width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff9300"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="9 6 15 12 9 18" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                    width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff9300"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            @endif

                            <span>{{ $task->title }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center ml-5">
                            @if ($task->completed == 0)
                                <form action="{{ route('todo.update', $task->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="text" value="1" name="statusOfComplete" hidden>
                                    <button class="btn btn-success" type="submit">Mark it complete</button>
                                </form>
                            @else
                                <form action="{{ route('todo.update', $task->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="text" value="0" name="statusOfComplete" hidden>
                                    <button class="btn btn-warning" type="submit">Mark it Uncomplete</button>
                                </form>
                            @endif
                            <form action="{{ route('todo.edit', $task->id) }}" method="get">
                                @csrf
                                <button type="submit" class="btn p-0 ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edid"
                                        width="30" height="30" viewBox="0 0 24 24" stroke-width="1" stroke="#ff9300"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                        <line x1="16" y1="5" x2="19" y2="8" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('todo.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                        width="30" height="30" viewBox="0 0 24 24" stroke-width="1" stroke="#ff9300"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="4" y1="7" x2="20" y2="7" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                <div class="paginate">
                    {{ $listOfTasks->links('pagination::bootstrap-4') }}

                </div>
            @else
                <h4 class="text-white mt-4">There is no task, create some!</h4>
            @endif

        </div>
    </div>
@endsection
