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

    /**
     * @dataProvider correctlyData
     */
    public function testSuccessStore(array $data)
    {
        $this->post('/api/links', $data)
        ->assertStatus(201);
    }

    public function correctlyData()
    {
        return [
            'with-slug' => [[
                'url' => 'http://example.com/to-encode',
                'slug' => 'test-slug',
            ]],
            'without-slug' => [[
                'url' => 'http://example.com/ewqewqe'
            ]]
        ];
    }

}
