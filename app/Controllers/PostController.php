<?php

namespace App\Controllers;

use App\Models\Post;
use Framework\Core\Controller;
use Framework\Http\Response;

class PostController extends Controller
{
  private Post $post;

  public function __construct($post = null)
  {
    $this->post = $post ?: new Post();
  }

  public function all()
  {
    $page = $this->request->query()['page'] ?? '1';
    $limit = (int) $this->request->query()['limit'] ?? '10';
    $results = $this->post->findMany($page, $limit);

    return new Response(
      json_encode([
        'page' => $results['page'],
        'totalPages' => $results['totalPages'],
        'posts' => array_map(function ($post) {
          return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt(),
          ];
        }, $results['posts']),
      ]),
      200,
      ['Content-Type' => 'application/json'],
    );
  }

  public function byId(string $id)
  {
    $post = $this->post->findOne($id);
    if (!$post) {
      return new Response(json_encode(['error' => 'Post not found']), 404, [
        'Content-Type' => 'application/json',
      ]);
    }
    return new Response(
      json_encode([
        'id' => $post->getId(),
        'title' => $post->getTitle(),
        'content' => $post->getContent(),
        'created_at' => $post->getCreatedAt(),
      ]),
      200,
      ['Content-Type' => 'application/json'],
    );
  }

  public function index()
  {
    $page = $this->request->query()['page'] ?? '1';
    $limit = $this->request->query()['limit'] ?? '9';
    $results = $this->post->findMany($page, $limit);

    return $this->view('posts.index', [
      'posts' => $results['posts'],
      'page' => $results['page'],
      'totalPages' => $results['totalPages'],
    ]);
  }

  public function show(string $id)
  {
    $post = $this->post->findOne($id);
    if (!$post) {
      return $this->view('_error', [
        'details' => 'The post you are trying to view does not exist.',
      ]);
    }
    return $this->view('posts.show', [
      'post' => $post,
    ]);
  }

  public function create()
  {
    return $this->view('posts.create');
  }

  public function edit(string $id)
  {
    $post = $this->post->findOne($id);
    if (!$post) {
      return $this->view('_error', [
        'details' => 'The post you are trying to edit does not exist.',
      ]);
    }
    return $this->view('posts.edit', [
      'post' => $post,
    ]);
  }

  public function store()
  {
    $body = $this->request->body();
    $post = new Post();
    if (isset($body['id'])) {
      $post->setId($body['id']);
    }
    $post->setTitle($body['title'] ?? '');
    $post->setContent($body['content'] ?? '');
    $post->save();
    return $this->redirect('/posts/' . $post->getId());
  }

  public function delete()
  {
    $body = $this->request->body();
    $post = $this->post->findOne($body['id'] ?? '');
    if (!$post) {
      return new Response(json_encode(['error' => 'Post not found']), 404, [
        'Content-Type' => 'application/json',
      ]);
    }
    $post->delete();
    return $this->redirect('/posts');
  }
}
