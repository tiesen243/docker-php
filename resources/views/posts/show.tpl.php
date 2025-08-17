@extends('_layouts.main')

@section('title')
  {{ $post->getTitle() }}
@endsection

@section('meta')
  <meta name="description" content="{{ $post->getContent() }}" />
@endsection

@section('content')
  <main class="container post-page">
    <article class="post">
      <h1 class="post__title">{{ $post->getTitle() }}</h1>
      <time class="post__date">{{ $post->getCreatedAt() }}</time>
      <hr class="post__separator" />
      <div class="post__content">{{ $post->getContent() }}</div>
    </article>
  </main>
@endsection

@section('styles')
  @resources('css/posts/show.css')
@endsection
