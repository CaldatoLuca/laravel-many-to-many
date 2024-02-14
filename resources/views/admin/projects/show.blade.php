@extends('layouts.admin')

@section('title')
    - {{ $project->title }}
@endsection

@section('content')
    <div id="show" class="container h-100">
        <div class="row justify-content-between h-100">
            <div class="col-12 d-flex  align-items-center justify-content-between">
                <h1>{{ $project->title }}</h1>

                <div class="links-utility d-flex gap-2">
                    {{-- list --}}
                    <a class="btn btn-back" href="{{ route('admin.projects.index') }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    {{-- edit --}}
                    <a class="btn btn-back" href="{{ route('admin.projects.edit', $project) }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    {{-- delete --}}
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                        @csrf

                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>

            {{-- info --}}
            <div class="col-4 pe-3 d-flex flex-column justify-content-center ">
                {{-- descrione --}}
                <div class="description">
                    <h4>Description:</h4>
                    @if ($project->description)
                        <div class="mb-3">{{ $project->description }}</div>
                    @else
                        <div class="mb-3">This Project has no description</div>
                    @endif
                </div>

                {{-- type --}}
                <div class="type d-flex">
                    <h5>Type: {{ $project->type?->title ?: 'This project has no types' }}</h5>
                </div>

                {{-- @dd($project->technologies) --}}

                {{-- technology --}}
                <div class="technology">
                    <h5>Technologies:</h5>
                    <ul class="list-group list-group-flush">
                        @if ($project->technologies != '[]')
                            @foreach ($project->technologies as $technology)
                                <li class="list-group-item rounded-1">{{ $technology->title }}</li>
                            @endforeach
                        @else
                            <li class="list-group-item rounded-1">This project has no technology</li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- immagine e repo --}}
            <div class="col-8 d-flex flex-column justify-content-center align-items-center">

                {{-- repo --}}
                <div class="repo d-flex">
                    <div class="mb-3">
                        @if ($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank">Repo Github</a>
                        @else
                            This projects has no github repository
                        @endif
                    </div>
                </div>

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
