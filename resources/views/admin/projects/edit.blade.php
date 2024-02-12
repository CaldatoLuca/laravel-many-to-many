@extends('layouts.admin')

@section('title')
    Edit - {{ $project->title }}
@endsection

@section('content')
    <div id="edit" class="container h-100">
        <div class="row h-100">
            <div class="col-12 d-flex  align-items-center justify-content-start">
                <h1>Edit: {{ $project->title }}</h1>
            </div>

            <div class="col-12">
                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">

                    {{-- token di laravel per controllo --}}
                    @csrf

                    {{-- aggiungiamo il metodo put --}}
                    @method('PUT')

                    <div class="row">
                        <div class="col-6">
                            {{-- titolo --}}
                            <div class="mb-3">
                                <label for="project-title" class="form-label d-flex justify-content-between ">
                                    Title
                                    {{-- errore titolo --}}
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                                <div class="input-group">

                                    {{-- input --}}
                                    <input type="text" class="my-input form-control @error('title') is-invalid @enderror"
                                        id="project-title" aria-describedby="basic-addon3 basic-addon4" name="title"
                                        value="{{ old('title', $project->title) }}" required>
                                </div>
                            </div>

                            {{-- descrizione --}}
                            <div class="mb-3">

                                <label for="project-description" class="form-label d-flex justify-content-between ">
                                    Description
                                    {{-- errore descrizione --}}
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                                <div class="input-group">
                                    {{-- input --}}
                                    <textarea class="my-input form-control @error('description') is-invalid @enderror" cols="30" rows="10"
                                        id="project-description" aria-label="With textarea" name="description">{{ old('description', $project->description) }}</textarea>
                                </div>
                            </div>

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
                                            @if (old('type_id', $project->type_id) == $type->id) selected @endif>{{ $type->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- bottone di invio --}}
                            <button type="submit" class="btn btn-form">Submit</button>
                        </div>

                        <div class="col-6">
                            {{--  immagine input --}}
                            <div class="mb-3">
                                <label for="project-img-edit" class="form-label d-flex justify-content-between ">
                                    Upload image
                                    {{-- errore url immagine --}}
                                    @error('thumb')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </label>
                                {{-- input --}}
                                <div class="input-group">
                                    <input class="upload-image my-input form-control @error('thumb') is-invalid @enderror"
                                        type="file" id="project-img-edit" name="thumb"
                                        value="{{ old('thumb', $project->thumb) }}">
                                    {{-- remove image --}}
                                    {{-- <button class="btn btn-form remove-image" type="button" id="button-addon2">
                                        <i class="fa-solid fa-trash"></i>
                                    </button> --}}
                                </div>
                            </div>

                            {{-- mostro  l'immagine del progetto se esiste, altrimenti una placeholder --}}
                            <div class="d-flex justify-content-center align-items-center flex-column">


                                @if ($project->thumb)
                                    <div class="mb-2 has-image">Image Preview</div>
                                    <div class="image-preview image-show d-flex justify-content-center align-items-center ">
                                        <img class="image rounded-2 " src="{{ asset('storage/' . $project->thumb) }}"
                                            alt="{{ $project->slug }}">
                                    </div>
                                @else
                                    <div class="mb-2 has-image">No Image Selected</div>
                                    <div
                                        class="image-preview image-placeholder rounded-2 bg-danger d-flex justify-content-center align-items-center ">
                                        <i class="fa-solid fa-x"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
