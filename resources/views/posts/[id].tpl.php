@extends('_layouts.main')

@section('title')
  {{ $post->getTitle() }}
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

  @resources('css/posts/[id].css')
@endsection
