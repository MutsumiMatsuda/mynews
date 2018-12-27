@extends('layouts.front')

@section('content')
  <div class="container">
    <hr color="#c0c0c0">
    <h1>{{ $post->title }}</h1>
    <hr color="#c0c0c0">
    <div class="body">{{ $post->body }}</div>
  </div>
@endsection
