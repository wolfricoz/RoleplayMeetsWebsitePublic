<?php

namespace Tests\Unit\Models;

use App\Models\Genres;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
  use RefreshDatabase;

  public function test_posts_can_be_filtered_by_search_term(): void
  {
    $user = User::factory()->create();
    $post1 = Post::factory()->create(['title' => 'Post with unique title']);
    $post2 = Post::factory()->create(['content' => 'Post with unique content']);
    $post3 = Post::factory()->create();

    $filteredPosts = Post::filter(['search' => 'unique'])->get();

    $this->assertCount(2, $filteredPosts);
    $this->assertTrue($filteredPosts->contains($post1));
    $this->assertTrue($filteredPosts->contains($post2));
    $this->assertFalse($filteredPosts->contains($post3));
  }

  public function test_posts_can_be_filtered_by_genre(): void
  {
    $user = User::factory()->create();
    $genre = Genres::factory()->create();
    $post1 = Post::factory()->create()->updateTags([$genre->name]);
    $post2 = Post::factory()->create()->updateTags([$genre->name]);
    $post3 = Post::factory()->create();

    $filteredPosts = Post::filter(['genre' => $genre->name])->get();
    $this->assertCount(2, $filteredPosts);
    $this->assertTrue($filteredPosts->contains($post1));
    $this->assertTrue($filteredPosts->contains($post2));
    $this->assertFalse($filteredPosts->contains($post3));
  }

  public function test_posts_can_be_filtered_by_approval_status(): void
  {
    $user = User::factory()->create();
    $approvedPost = Post::factory()->create(['approved' => true]);
    $unapprovedPost = Post::factory()->create(['approved' => false]);

    $approvedPosts = Post::approved(true)->get();
    $this->assertCount(1, $approvedPosts);
    $this->assertTrue($approvedPosts->contains($approvedPost));
    $this->assertFalse($approvedPosts->contains($unapprovedPost));
  }

  public function test_post_belongs_to_a_genre(): void
  {
    $user = User::factory()->create();
    $genre = Genres::factory()->create();
    $post = Post::factory()->create()->updateTags([$genre->name]);

    $this->assertEquals($genre->name, $post->tags()->first()->name);
  }

  public function test_post_belongs_to_a_user(): void
  {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $this->assertEquals($user->id, $post->user->id);
  }
}
