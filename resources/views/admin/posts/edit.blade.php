@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Modifica: {{ $post->title }}</h1>
    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input value="{{ old('title', $post->title) }}" type="text" name="title" class="form-control" id="title" placeholder="Titolo">
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Contenuto Post</label>
        <textarea class="form-control" id="content" name="content" rows="3">{{ old('content', $post->content)  }}</textarea>
      </div>
        <button type="submit" class="btn btn-success">Invia</button>
    </form>
    
  </div>



  </div>
@endsection

@section('title')
  Edit
@endsection