@extends('layouts.admin')

@section('title')
    - Create Type
@endsection

@section('content')
    <div id="create_type" class="container h-100">
        <div class="row h-100">
            <div class="col-12 d-flex  align-items-center justify-content-between">
                <h1 class="mb-5">New Type</h1>
                {{-- back button --}}
                <a class="btn btn-back" href="{{ route('admin.types.index') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>


            <div class="col-12">
                <form action="{{ route('admin.types.store') }}" method="POST" class="h-100">

                    {{-- token di laravel per controllo --}}
                    @csrf

                    {{-- titolo --}}
                    <label for="type-title" class="form-label d-flex justify-content-between ">
                        Type Title
                        {{-- errore titolo --}}
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>
                    <div class="input-group">

                        {{-- input --}}
                        <input type="text" class="my-input mb-3 form-control @error('title') is-invalid @enderror"
                            id="type-title" aria-describedby="basic-addon3 basic-addon4" name="title" required>
                    </div>


                    {{-- bottone di invio --}}
                    <button type="submit" class="btn btn-form">Submit</button>

                </form>
            </div>
        </div>
    </div>
@endsection
