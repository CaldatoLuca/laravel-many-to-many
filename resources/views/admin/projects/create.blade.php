@extends('layouts.admin')

@section('title')
    - Create
@endsection

@section('content')
    <div id="create" class="container h-100">
        <div class="row h-100">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <h1>New Project</h1>
                {{-- back button --}}
                <a class="btn btn-back" href="{{ route('admin.projects.index') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>


            <div class="col-12">
                <form action="{{ route('admin.projects.store') }}" method="POST" class="h-100"
                    enctype="multipart/form-data">

                    {{-- token di laravel per controllo --}}
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            {{-- titolo --}}
                            <div class="mb-3">
                                <label for="project-title" class="form-label d-flex justify-content-between ">
                                    Project Title
                                    {{-- errore titolo --}}
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                                <div class="input-group">

                                    {{-- input --}}
                                    <input type="text" class="my-input form-control @error('title') is-invalid @enderror"
                                        id="project-title" aria-describedby="basic-addon3 basic-addon4" name="title"
                                        value="{{ old('title') }}" required>
                                </div>
                            </div>

                            {{-- url repo --}}
                            <div class="mb-3">
                                <label for="project-github-url" class="form-label d-flex justify-content-between ">
                                    Project Repo
                                    {{-- errore titolo --}}
                                    @error('github_url')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                                <div class="input-group">

                                    {{-- input --}}
                                    <input type="text"
                                        class="my-input form-control @error('github_url') is-invalid @enderror"
                                        id="project-github-url" aria-describedby="basic-addon3 basic-addon4"
                                        name="github_url" value="{{ old('github_url') }}">
                                </div>
                            </div>

                            {{-- descrizione --}}
                            <div class="mb-3">
                                <label for="project-description" class="form-label d-flex justify-content-between ">
                                    Project Description
                                    {{-- errore descrizione --}}
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                                <div class="input-group">
                                    {{-- input --}}
                                    <textarea class="my-input form-control @error('description') is-invalid @enderror" cols="30" rows="10"
                                        id="project-description" aria-label="With textarea" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            {{-- technologies --}}
                            <div class="mb-3">
                                <label class="form-label d-flex justify-content-between ">
                                    Technologies
                                    {{-- errore url immagine --}}
                                    @error('technologies')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                                {{-- input --}}
                                <div class="input-group">
                                    @foreach ($technologies as $technology)
                                        <div class="form-check form-check-inline">
                                            <input class="my-input form-check-input" type="checkbox"
                                                id="technology-{{ $technology->id }}" value="{{ $technology->id }}"
                                                name="technologies[]" {{-- se otteno errori mantengo selezionate le checkbox
                                                    in_array cerca un elemento in un array e da true
                                                    passo array vuoto se non seleziono nesuna check --}}
                                                {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                                            {{-- mando un array --}}
                                            <label class="form-check-label"
                                                for="technology-{{ $technology->id }}">{{ $technology->title }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- bottone di invio --}}
                            <button type="submit" class="btn btn-form">Submit</button>
                        </div>

                        <div class="col-6">
                            {{-- types --}}
                            <div class="mb-3">
                                <label for="project-type" class="form-label d-flex justify-content-between ">
                                    Select Type
                                    {{-- errore descrizione --}}
                                    @error('type_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                                {{-- input --}}
                                <select class="my-input form-select @error('type_id') is-invalid @enderror"
                                    aria-label="Default select example" name="type_id">
                                    <option selected>No Type Selected</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            @if (old('type_id') == $type->id) selected @endif>{{ $type->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{--  immagine --}}
                            <div class="mb-3">
                                <label for="project-img" class="form-label d-flex justify-content-between ">
                                    Upload image
                                    {{-- errore url immagine --}}
                                    @error('thumb')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                                {{-- input --}}
                                <div class="input-group">
                                    <input class="upload-image my-input form-control @error('thumb') is-invalid @enderror"
                                        type="file" id="project-img" name="thumb" value="{{ old('thumb') }}">
                                    {{-- remove image --}}
                                    <button class="btn btn-form remove-image" type="button" id="button-addon2">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- mostro  l'immagine del progetto se esiste, altrimenti una placeholder --}}
                            <div class="d-flex justify-content-center align-items-center flex-column mb-3">

                                <div class="mb-2 has-image"></div>
                                <div
                                    class="image-preview image-placeholder d-flex justify-content-center align-items-center rounded-2 bg-danger">

                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
