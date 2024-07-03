<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     */
    public function test_user_can_create_post(): void
    {
        $user = User::factory()->create();
        Post::create([
            'user_id'      => $user->id,
            'post_content' => 'hello'
        ]);

        $this->assertDatabaseHas('posts', 
        [
            'user_id'      => $user->id,
            'post_content' => 'hello'
        ]);
    }

    /**
     * A basic test example.
     */
    public function test_user_can_create_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        Comment::create(
            [
                'user_id'      => $user->id,
                'comment_text' => 'comment here on hello',
                'post_id'      => $post->id
            ]);
            $this->assertDatabaseHas('comments', 
            [
                'user_id'      => $user->id,
                'comment_text' => 'comment here on hello',
                'post_id'      => $post->id
            ]);
    }
   
    /**
     * @return void
     */
    public function test_user_can_like_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        Like::create(
            [
                'user_id'       => $user->id,
                'likeable_id'   => $post->id,
                'likeable_type' => Post::class
            ]);
            $this->assertDatabaseHas('likes', 
            [
                'user_id'       => $user->id,
                'likeable_id'   => $post->id,
                'likeable_type' => Post::class
            ]);
            $this->assertTrue($post->likes->count()===1);
    }
    
    /**
     * @return void
     */
    public function test_user_can_like_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'post_id' => $post->id
        ]);

        Like::create(
            [
                'user_id'       => $user->id,
                'likeable_id'   => $comment->id,
                'likeable_type' => Comment::class
            ]);
        $this->assertDatabaseHas('likes', 
        [
            'user_id'       => $user->id,
            'likeable_id'   => $comment->id,
            'likeable_type' => Comment::class
        ]);
        $this->assertTrue($comment->likes->count()===1);
    }
}
