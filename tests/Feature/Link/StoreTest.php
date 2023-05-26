<?php

namespace Tests\Feature\Link;

use App\Models\User;
use Database\Seeders\Tests\TestUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        $this->seed(TestUserSeeder::class);
        $this->actingAs(User::find(1));
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function testSuccessStore()
    {
        $this->post('/api/links', [
            'url' => 'http://example.com/to-encode'
        ])->assertStatus(201);
    }

}
