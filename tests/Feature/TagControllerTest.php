<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method of TagController
     *
     * @return void
     */
    public function testIndex()
    {
        $tags = Tag::factory()->count(5)->create();


        $response = $this->get(route('tags.index'));
        $response->assertRedirect(route('login'));

        $response = $this->followRedirects($response);
        $response->assertViewIs('auth.login');
    }

    /**
     * Test the create method of TagController
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->get(route('tags.create'));
        $response->assertRedirect(route('login'));

        $response = $this->followRedirects($response);
        $response->assertViewIs('auth.login');
    }

    /**
     * Test the store method of TagController
     *
     * @return void
     */
    public function testStore()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        $response = $this->post(route('tags.store'), [
            'name' => 'Test Tag',
        ]);

        $response->assertRedirect(route('tags.index'));
        $response->assertSessionHas('success', 'Tag created successfully.');
    }

    /**
     * Test the edit method of TagController
     *
     * @return void
     */
    public function testEdit()
    {
        $tag = Tag::factory()->create();

        $response = $this->get(route('tags.edit', $tag->id));
        $response->assertRedirect(route('login'));

        $response = $this->followRedirects($response);
        $response->assertViewIs('auth.login');
    }

    /**
     * Test the update method of TagController
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        $tag = Tag::factory()->create();
        $response = $this->put(route('tags.update', $tag->id), [
            'name' => Str::random(10),
        ]);

        $response->assertRedirect(route('tags.index'));
        $response->assertSessionHas('success', 'Tag updated successfully.');
    }

    /**
     * Test the destroy method of TagController
     *
     * @return void
     */
    public function testDestroy()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        $tag = Tag::factory()->create();

        $response = $this->delete(route('tags.destroy', $tag->id));
        $response->assertRedirect(route('tags.index'));
        $response->assertSessionHas('success', 'Tag deleted successfully.');
    }
}
