<?php

namespace Tests\Feature\Link;

use App\Models\User;
use Database\Seeders\Tests\TestLinkSeeder;
use Database\Seeders\Tests\TestUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        $this->seed(TestUserSeeder::class);
        $this->seed(TestLinkSeeder::class);
        $this->actingAs(User::find(1));
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function testSuccessUpdate()
    {
        $this->put('/api/links/1', [
            'title' => 'Title Teste Update',
            'url' => 'http://example.com/to-encode',
            'slug' => 'teste',
        ])
        ->assertStatus(200);
        $this->assertDatabaseHas('links', [
            'id' => 1,
            'title' => 'Title Teste Update'
        ]);
    }

    public function testExistingSlug()
    {
        $this->put('/api/links/1', [
            'title' => 'Teste',
            'url' => 'http://example.com/to-encode',
            'slug' => 'teste-2',
        ])
        ->assertStatus(422)->assertJsonStructure([
            'errors'=>['slug']
        ]);
    }
}
