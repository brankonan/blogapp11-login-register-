@extends('layout.default')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>

    @foreach ($post->tags as $tag)
        <a href="/tags/{{ $tag->name }}" class="badge rounded-pill text-bg-secondary">{{ $tag->name }}</a>        
    @endforeach
    @if (auth()->user() &&  auth()->user()->id === $post->user_id)
        <form action="{{ url('posts/' . $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input class="form-control" type="text" name="title" placeholder="Edit title" required />
                <input class="form-control" type="text" name="body" placeholder="Edit body" required />
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
        <form action="{{ url('posts/' . $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Delete</button>
            </div>
        </form>
    @endif

    <h2>Comments</h2>
    @foreach ($comments as $comment)
        @include('components.comments')
    @endforeach
    @if (auth()->user())
        @include('components.createcomment')
    @else
        <h4>Ulogujte se da biste ostavili komentar.</h4>
    @endif
@endsection
