@extends('_layouts.main')

@section('title')
  Posts
@endsection

@section('content')
  <main class="container posts-page">
    <h1 class="posts-page__title">Posts</h1>

    <div class="posts-page__list">
      @foreach ($posts as $post)
        <a href="/posts/{{ $post->getId() }}" class="card">
          <div class="card__header">
            <h2 class="card__title">{{ $post->getTitle() }}</h2>
            <time class="card__description">{{ $post->getCreatedAt() }}</time>
            <form action="/posts/delete" method="POST" class="card__action">
              <input type="hidden" name="id" value="{{ $post->getId() }}" />
              <button class="ui-button ui-button--ghost ui-button--size-icon">
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          </div>
          <div class="card__content">
            <p>{{ $post->getContent() }}</p>
          </div>
        </a>
      @endforeach
    </div>

    <div class="posts-page__pagination">
      @if ($page > 1)
        <a
          href="/posts?page={{ $page - 1 }}"
          class="ui-button ui-button--outline ui-button--size-icon"
        >
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      @endif

      <span>Page {{ $page }} of {{ $totalPages }}</span>

      @if ($page < $totalPages)
        <a
          href="/posts?page={{ $page + 1 }}"
          class="ui-button ui-button--outline ui-button--size-icon"
        >
          <i class="fa-solid fa-chevron-right"></i>
        </a>
      @endif
    </div>
  </main>

  @resources('css/posts/index.css')
  @resources('css/components/ui/button.css')
  @resources('css/components/ui/card.css')
@endsection
