<?php

namespace App\Controllers;

use App\Models\Post;
use Framework\Core\Controller;
use Framework\Http\Response;

class PostController extends Controller
{
  public function index(): Response
  {
    $posts = Post::findMany();

    return $this->render('posts/index', [
      'posts' => $posts,
      'title' => 'Posts',
      'description' => 'List of all posts.',
    ]);
  }

  public function all(): Response
  {
    $posts = Post::findMany();
    return $this->json($posts);
  }

  public function show(string $id): Response
  {
    $post = Post::findOne($id);

    if (!$post) {
      return $this->render('_error', [
        'message' => '404',
        'details' => 'The post you are looking for does not exist.',
      ]);
    }
    return $this->render('posts/[id]/index', [
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

  public function edit(string $id): Response
  {
    $post = Post::findOne($id);

    if (!$post) {
      return $this->render('_error', [
        'message' => '404',
        'details' => 'The post you are trying to edit does not exist.',
      ]);
    }

    return $this->render('posts/[id]/edit', [
      'post' => $post,
      'title' => 'Edit Post',
      'description' => 'Edit the post details.',
    ]);
  }

  public function store(): Response
  {
    $body = $this->request->body();
    $post = new Post([
      'id' => $body['id'] ?? '',
      'title' => $body['title'] ?? '',
      'content' => $body['content'] ?? '',
    ]);

    $post->save();

    return new Response(null, 302, [
      'Location' => '/posts/' . $post->id,
    ]);
  }

  public function delete(string $id): Response
  {
    $post = new Post(['id' => $id]);
    if ($post->delete()) {
      return new Response(null, 302, [
        'Location' => '/posts',
      ]);
    } else {
      return $this->render('_error', [
        'message' => 'Error',
        'details' => 'Failed to delete the post. It may not exist.',
      ]);
    }
  }
}
