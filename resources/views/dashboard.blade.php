@extends('layouts.admin')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-between h-100">
            {{-- welcome --}}
            <div class="col-12 d-flex align-items-center ">
                <h1>Welcome {{ Auth::user()->name }}</h1>
            </div>

            {{-- latest projects --}}
            <div class="col-8 rounded-2 dasboard-style p-3 mb-3 d-flex flex-column justify-content-around ">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Your latest Projects</h2>
                    {{-- back button --}}
                    <a class="btn btn-back" href="{{ route('admin.projects.index') }}">
                        View All
                    </a>
                </div>
                {{-- tabella --}}
                <div>
                    @if ($projects !== '[]')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col" class="text-center">View More</th>
                                    <th scope="col" class="text-center">Edit</th>
                                    <th scope="col" class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $key => $project)
                                    @if ($key > count($projects) - 7)
                                        <tr>
                                            {{-- id --}}
                                            <td>{{ $project->id }}</td>

                                            {{-- titolo --}}
                                            <td>{{ $project->title }}</td>

                                            {{-- show --}}
                                            <td class="text-center">
                                                <a href="{{ route('admin.projects.show', $project) }}"
                                                    class="btn btn-details"><i class="fa-regular fa-square-plus"></i></a>
                                            </td>

                                            {{-- edit --}}
                                            <td class="text-center">
                                                <a href="{{ route('admin.projects.edit', $project) }}"
                                                    class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </td>

                                            {{-- delete --}}
                                            <td class="text-center">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $project->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $project->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $project->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you
                                                                    sure?
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Do you really want to delete this record? This process
                                                                cannot be
                                                                undone.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <form
                                                                    action="{{ route('admin.projects.destroy', $project) }}"
                                                                    method="POST">
                                                                    @csrf

                                                                    @method('DELETE')

                                                                    <button type="submit" class="btn btn-danger">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="warning-dash">
                            <h3>You have no Projects Yet</h3>
                            <h4>
                                Click <a href="{{ route('admin.projects.create') }}">here</a> to insert one
                            </h4>
                        </div>
                    @endif
                </div>
            </div>

            {{-- latest activities --}}
            <div class="col-3 rounded-2 dasboard-style p-3 mb-3 d-flex flex-column pt-5">
                <h2 class="mb-5">Latest Activities</h2>

                @if ($notifications)
                    <ul class="list-group">
                        @foreach ($notifications as $key => $notification)
                            @if ($key > count($notifications) - 8)
                                <li class="list-group-item">{{ $notification }}</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="col-12 rounded-2 dasboard-style p-3">

            </div>
        </div>

    </div>

    </div>
@endsection
