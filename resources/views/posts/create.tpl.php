@extends('_layouts.main')

@section('title')
  Create Post
@endsection

@section('content')
  <main class="container">
    <form action="/posts/store" method="POST" class="post-form">
      <div class="post-form__field">
        <label for="title" class="ui-label">Title</label>
        <input
          id="title"
          class="ui-input"
          name="title"
          type="text"
          placeholder="Enter post title"
          required
        />
      </div>

      <div class="post-form__field">
        <label for="content" class="ui-label">Content</label>
        <textarea
          id="content"
          class="ui-textarea"
          name="content"
          placeholder="Enter post content"
          required
        ></textarea>
      </div>

      <button class="ui-button ui-button--default ui-button--size-default">
        Create
      </button>
    </form>
  </main>

  @resources('css/posts/form.css')
  @resources('css/components/ui/input.css')
  @resources('css/components/ui/textarea.css')
  @resources('css/components/ui/label.css')
@endsection
