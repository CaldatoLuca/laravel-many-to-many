@extends('layouts.admin')

@section('title')
    - {{ $project->title }}
@endsection

@section('content')
    <div id="show" class="container h-100">
        <div class="row justify-content-between h-100">
            <div class="col-12 d-flex  align-items-center justify-content-between">
                <h1>{{ $project->title }}</h1>
                <a class="btn btn-back" href="{{ route('admin.projects.index') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            {{-- info --}}
            <div class="col-4 pe-3">
                {{-- descrione --}}
                <div class="description">
                    <h3>Description:</h3>
                    <div class="mb-3">{{ $project->description }}</div>
                </div>

                {{-- type --}}
                <div class="type">
                    <h3>Type:</h3>
                    <div class="mb-3">{{ $project->type?->title ?: 'This project has no types' }}</div>
                </div>

                {{-- technology --}}
                <div class="technology">
                    <h3>Technologies:</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($project->technologies as $technology)
                            <li class="list-group-item rounded-1">{{ $technology->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- immagine --}}
            <div class="col-8 d-flex justify-content-center align-items-center">

                {{-- mostro  l'immagine del progetto se esiste, altrimenti una placeholder --}}
                @if ($project->thumb)
                    <div class="rounded-2 overflow-hidden image-show">
                        <img src="{{ asset('storage/' . $project->thumb) }}" alt="{{ $project->slug }}">
                    </div>
                @else
                    <div class="image-placeholder d-flex justify-content-center align-items-center rounded-2 bg-danger">
                        <i class="fa-solid fa-x"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
