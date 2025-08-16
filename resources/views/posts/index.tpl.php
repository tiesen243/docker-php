@extends('_layouts.main')

@section('title')
  Posts
@endsection

@section('content')
  <main class="container posts-page">
    <h1 class="posts-page__title">Posts</h1>

    <div class="posts-page__list">
      @foreach ($posts as $post)
        <article class="post">
          <h2 class="post__title">{{ $post->getTitle() }}</h2>
          <p class="post__content">{{ $post->getContent() }}</p>
          <time class="post__date">{{ $post->getCreatedAt() }}</time>
        </article>
      @endforeach
    </div>
  </main>

  @resources('css/posts/index.css')
@endsection
