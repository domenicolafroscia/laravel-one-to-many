@extends('layouts.admin')

@section('content')
    <div class="container mt-5">

        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif

        <h2>{{ $project->title }}</h2>

        <p>
            Type: {{ $project->type ? $project->type->name : 'No type'}}
        </p>

        @if ($project->cover_image)
            <div>
                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="">
            </div>
        @else
            <p class="alert alert-warning">No image present</p>
        @endif

        <div class="mt-4">
            Data: {{ $project->created_at }}
        </div>

        <div class="mt-4">
            Slug: {{ $project->slug }}
        </div>

        <p class="mt-4">
            {{ $project->content }}
        </p>


        <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Projects list</a>


    </div>
@endsection
