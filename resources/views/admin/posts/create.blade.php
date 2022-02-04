@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Nuovo post</h1>

    @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
    </ul>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input value="{{ old('title') }}" type="text" name="title" class="form-control" id="title" placeholder="Titolo">
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Contenuto Post</label>
        <textarea class="form-control" id="content" name="content" rows="3">{{ old('content') }}</textarea>
      </div>
        <button type="submit" class="btn btn-success">Invia</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
    
  </div>
@endsection

@section('title')
  Create
@endsection