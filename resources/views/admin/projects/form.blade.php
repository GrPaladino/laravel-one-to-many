@extends('layouts.app')

@section('title', 'Modifica progetto')

@section('content')
<section>
    <div class="container py-4">

        <a href="{{route('admin.projects.index')}}" class="btn btn-primary my-3">Torna alla lista</a>




        <h1 class="my-3">{{empty($project->id) ? "Crea Progetto" : "Modifica Progetto"}}</h1>
        <form action="{{ empty($project->id) ? route('admin.projects.store') : route('admin.projects.update', $project) }}" method="POST">
            @csrf
            @if($project->id)
            @method('PUT')
            @endif

            <label for="title" class="form-label">Titolo: </label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ empty($project->id) ? '' : old('title') ?? $project->title }}" required max="50" />
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <label for="github_url" class="form-label">Github: </label>
            <input type="url" class="form-control @error('github_url') is-invalid @enderror" id="github_url" name="github_url" value="{{ empty($project->id) ? '' : old("github_url") ?? $project->github_url }}" />
            @error('github_url')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <label for="image_preview" class="form-label">Immagine: </label>
            <input type="url" class="form-control @error('image_preview') is-invalid @enderror" id="image_preview" name="image_preview" value="{{ empty($project->id) ? '' : old("image_preview") ?? $project->image_preview }}" />
            @error('image_preview')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror




            <label for="description" class="form-label">Descrizione: </label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ empty($project->id) ? '' : old("description") ?? $project->description }}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <button type="submit" class="btn btn-success mt-2"><i class="fa-solid fa-floppy-disk me-2"></i>Salva</button>
        </form>

    </div>
</section>
@endsection


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
