<?php

namespace App\Controllers;

use App\Models\Post;
use Framework\Core\Controller;
use Framework\Http\Response;

class PostController extends Controller
{
  public function all()
  {
    $page = $this->request->query()['page'] ?? '1';
    $results = Post::findMany($page);
    return new Response(
      json_encode([
        'page' => $results['page'],
        'totalPages' => $results['totalPages'],
        'posts' => array_map(function ($post) {
          return $post->getProperties();
        }, $results['posts']),
      ]),
      200,
      [
        'Content-Type' => 'application/json',
      ],
    );
  }

  public function byId(string $id)
  {
    $post = Post::findOne($id);
    if (!$post) {
      return new Response(json_encode(['error' => 'Post not found']), 404, [
        'Content-Type' => 'application/json',
      ]);
    }
    return new Response(json_encode($post->getProperties()), 200, [
      'Content-Type' => 'application/json',
    ]);
  }

  public function index()
  {
    $page = $this->request->query()['page'] ?? '1';
    $results = Post::findMany($page);

    return $this->view('posts.index', [
      'posts' => $results['posts'],
    ]);
  }
}
