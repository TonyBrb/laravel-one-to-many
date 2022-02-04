@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Elenco posts</h1>
        @if (session('deleted'))
          {{ session('deleted') }}
        @endif
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titolo</th>
      <th scope="col">Categoria</th>
      <th scope="col">Slug</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
      <tr>
      <th scope="row">{{ $post->id }}</th>
      <td>{{ $post->title }}</td>
      @if ($post->category)
        <td>{{ $post->category->name }}</td>
      @else
        <td>-</td>
      @endif
      
      <td>{{ $post->slug }}</td>
      <td><a href="{{ route('admin.posts.show',$post) }}" class="btn btn-info">SHOW</a></td>
      <td><a href="{{ route('admin.posts.edit',$post) }}" class="btn btn-success">EDIT</a></td>
      <td>
        <form onsubmit="return confirm('Confermi eliminazione post?')" 
        action="{{ route('admin.posts.destroy', $post) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">DELETE</button>
      </form>
    </tr>
    @endforeach
    
    
  </tbody>
</table>
  {{ $posts->links() }}
    </div>
    @foreach ($categories as $category)
            <h2>{{$category->name}}</h2>
            <ul>
            @foreach ($category->posts as $item)
                <li><a href="{{ route('admin.posts.show', $item) }}">{{ $item->title }}</a></li>
            @endforeach
              
            </ul>
    @endforeach

</div>


@endsection

@section('title')
  Elenco post
@endsection