@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif

  @if (session('status'))
      <div class="alert alert-success" role="alert">
          {{ session('status') }}
      </div>
  @endif
<div>
  <form action="/search" method="post" role="search">
    {{ csrf_field() }}
    <div class="input-group">
      <input type="text" class="form-control" name="q" placeholder="Search users">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          <span class="glyphicon glyphicon-search">Search</span>
        </button>
      </span>
    </div>
  </form>
</div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Title</td>
          <td>Post</td>
          <td>Created at</td>
        </tr>
    </thead>
    <tbody>

        @foreach($posts as $post)
        <tr>
            <td>{{$post->post_name}}</td>
            <td>{{Str::limit($post->post_text, 50)}}</td>
            <td>{{$post->created_at}}
            @auth

            <td><a href="{{ route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('posts.destroy', $post->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            @else
            @endauth
        </tr>

        @endforeach
    </tbody>
  </table>

<div>
@endsection
