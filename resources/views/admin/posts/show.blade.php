@extends('layouts.app')

@section('content')
  <div class="container">
      <h1>{{ $post->title }}</h1>
      <p>{{ $post->content }}</p>
  </div>
  <div class="container">
    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-success">EDIT</a>
    <a href="#" class="btn btn-danger">DELETE</a>
  </div>
@endsection

@section('title')
  {{$post->title}}
@endsection