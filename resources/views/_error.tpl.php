@extends('_layouts.main')

@section('title')
  Page Not Found
@endsection

@section('content')
  <main class="container not-found-page">
    <div class="not-found-page__inner">
      <div class="not-found-page__content">
        <h1 class="not-found-page__title">
          {{ $message ?? '404' }}
        </h1>
        <div class="not-found-page__separator"></div>
        <p class="not-found-page__subtitle">
          {{ $details ?? 'This page could not be found.' }}
        </p>
      </div>
    </div>
  </main>

  @resources('css/not-found.css')
@endsection
