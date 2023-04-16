<?php
// tests/Feature/PostControllerTest.php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create(['user_id' => $this->user->id]);
        $this->tags = Tag::factory()->count(3)->create();

    }

    /** @test */
    public function user_must_be_logged_in_to_create_post()
    {
        // Test user is not logged in
        $response = $this->post(route('posts.store'));
        $response->assertRedirect(route('login'));

        // Test user is logged in
        $this->actingAs($this->user);

        $postData = [
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->paragraph,
            'tags' => $this->tags->pluck('id')->toArray()
        ];

        $response = $this->post(route('posts.store'), $postData);

        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHas('success', 'Your post submitted successfully');

    }

    /** @test */
    public function user_must_be_logged_in_to_update_post()
    {
        // Test user is not logged in
        $response = $this->put(route('posts.update', $this->post->id));
        $response->assertRedirect(route('login'));

        // Test user is logged in
        $this->actingAs($this->user);

        $updatedData = [
            'title' => $this->faker->name, // Limit the title length to 55 characters
            'content' => $this->faker->paragraph,
            'tags' => $this->tags->pluck('id')->toArray()
        ];

        $response = $this->put(route('posts.update', $this->post->id), $updatedData);

        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHas('success', 'Your post updated successfully');

        $this->post->refresh();
        $this->assertEquals($updatedData['title'], $this->post->title);
        $this->assertEquals($updatedData['content'], $this->post->content);
    }

    /** @test */
    public function user_must_be_logged_in_to_delete_post()
    {
        // Test user is not logged in
        $response = $this->delete(route('posts.destroy', $this->post->id));
        $response->assertRedirect(route('login'));

        // Test user is logged in
        $this->actingAs($this->user);

        $response = $this->delete(route('posts.destroy', $this->post->id));

        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHas('success', 'Your post deleted successfully');

        $this->assertDatabaseMissing('posts', ['id' => $this->post->id]);
    }
}
