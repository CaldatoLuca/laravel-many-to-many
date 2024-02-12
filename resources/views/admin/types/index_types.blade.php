@extends('layouts.admin')

@section('title')
    - Your Types
@endsection

@section('content')
    <div id="index-type" class="container">
        <h1 class="mb-5">Types List</h1>

        @if ($types != '[]')
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col" class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            {{-- id --}}
                            <td>{{ $type->id }}</td>

                            {{-- titolo --}}
                            <td>{{ $type->title }}</td>

                            <td class="text-center">

                                <form action="{{ route('admin.types.destroy', $type->slug) }}" method="POST">
                                    @csrf

                                    {{-- aggiungo il metodo delete --}}
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
                <h2>You have no Types Yet</h2>
                <h3>Click on New Type to insert one</h3>
            </div>
        @endif
    </div>
@endsection
