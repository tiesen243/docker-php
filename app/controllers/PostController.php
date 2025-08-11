<?php

namespace App\controllers;

use App\models\PostModel;
use Yuki\Core\Controller;
use Yuki\Http\Response;

class PostController extends Controller
{
  private PostModel $post;

  public function __construct()
  {
    $this->post = new PostModel();
  }

  public function show(string $id): Response
  {
    $post = $this->post->byId($id);

    if (!$post) {
      return $this->render('_error', [
        'message' => '404',
        'details' => 'The post you are looking for does not exist.',
      ]);
    }
    return $this->render('posts/index', [
      'post' => $post,
      'title' => $post['title'] ?? 'Post Not Found',
      'description' => $post['description'] ?? 'No description available.',
    ]);
  }

  public function create(): Response
  {
    return $this->render('posts/create', [
      'title' => 'Create Post',
      'description' => 'Create a new post.',
    ]);
  }

  public function store(): Response
  {
    $body = $this->request->getServerInfo()['post'];

    $id = $this->post->create([
      'title' => $body['title'] ?? '',
      'content' => $body['content'] ?? '',
    ]);

    if (!$id) {
      return new Response('Failed to create post', 500, [
        'Content-Type' => 'text/plain',
      ]);
    }

    return new Response(null, 302, [
      'Location' => '/posts/' . $id,
    ]);
  }

  public function edit(string $id): Response
  {
    $post = $this->post->byId($id);

    if (!$post) {
      return $this->render('_error', [
        'message' => '404',
        'details' => 'The post you are trying to edit does not exist.',
      ]);
    }

    return $this->render('posts/edit', [
      'post' => $post,
      'title' => 'Edit Post',
      'description' => 'Edit the post details.',
    ]);
  }

  public function update(string $id): Response
  {
    $body = $this->request->getServerInfo()['post'];

    if (
      !$this->post->update($id, [
        'title' => $body['title'] ?? '',
        'content' => $body['content'] ?? '',
      ])
    ) {
      return new Response('Failed to update post', 500, [
        'Content-Type' => 'text/plain',
      ]);
    }

    return new Response(null, 302, [
      'Location' => '/posts/' . $id,
    ]);
  }

  public function delete(string $id): Response
  {
    if (!$this->post->delete($id)) {
      return new Response('Failed to delete post', 500, [
        'Content-Type' => 'text/plain',
      ]);
    }

    return new Response(null, 302, [
      'Location' => '/',
    ]);
  }
}
