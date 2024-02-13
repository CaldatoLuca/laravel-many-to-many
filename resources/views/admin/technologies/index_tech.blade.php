@extends('layouts.admin')

@section('title')
    - Your Technologies
@endsection

@section('content')
    <div id="index-tech" class="container">
        <h1 class="mb-5">Technology List</h1>

        @if ($technologies != '[]')
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col" class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($technologies as $technology)
                        <tr>
                            {{-- id --}}
                            <td>{{ $technology->id }}</td>

                            {{-- titolo --}}
                            <td>{{ $technology->title }}</td>

                            {{-- cancellazione --}}
                            <td class="text-center">

                                <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="warning">
                <h2>You have no Technologies Yet</h2>
                <h3>Click on New Technology to insert one</h3>
            </div>
        @endif
    </div>
@endsection
