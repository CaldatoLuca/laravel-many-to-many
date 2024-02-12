@extends('layouts.admin')

@section('title')
    - Your Projects
@endsection

@section('content')
    <div id="index" class="container">
        <h1 class="mb-5">Project List</h1>

        @if ($projects != '[]')
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col" class="text-center">Type</th>
                        <th scope="col" class="text-center">Thumb</th>
                        <th scope="col" class="text-center">View More</th>
                        <th scope="col" class="text-center">Edit</th>
                        <th scope="col" class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            {{-- id --}}
                            <td>{{ $project->id }}</td>

                            {{-- titolo --}}
                            <td>{{ $project->title }}</td>

                            {{-- slug --}}
                            <td>{{ $project->slug }}</td>

                            {{-- type --}}
                            <td class="text-center">
                                @if ($project->type)
                                    {{ $project->type->title }}
                                @else
                                    <i class="fa-solid fa-square-xmark"></i>
                                @endif
                            </td>

                            {{-- ha immagine? --}}
                            <td class="text-center">
                                @if ($project->thumb)
                                    <i class="fa-regular fa-square-check"></i>
                                @else
                                    <i class="fa-solid fa-square-xmark"></i>
                                @endif
                            </td>

                            {{-- show --}}
                            <td class="text-center">
                                <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-details"><i
                                        class="fa-regular fa-square-plus"></i></a>
                            </td>

                            {{-- edit --}}
                            <td class="text-center">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-edit"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
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
                                    aria-labelledby="exampleModalLabel{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Do you really want to delete this record? This process cannot be undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('admin.projects.destroy', $project) }}"
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
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="warning">
                <h2>You have no Projects Yet</h2>
                <h3>Click on New Project to insert one</h3>
                @if ($types == '[]')
                    <h4>Also, remember to insert at least a Type of project. Click on New Type</h4>
                @endif
            </div>
        @endif
    </div>
@endsection
