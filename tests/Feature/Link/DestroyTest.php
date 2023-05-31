<?php

namespace Tests\Feature\Link;

use App\Models\User;
use Database\Seeders\Tests\TestLinkSeeder;
use Database\Seeders\Tests\TestUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
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
        $this->delete('/api/links/1')
        ->assertStatus(204);
        $this->assertDatabaseMissing('links', ['id' => 1]);
    }

    /**
     * @dataProvider invalidIdsData
     */
    public function testOtherUserDelete(int $id)
    {
        $this->delete('/api/links/'.$id)
        ->assertStatus(404);
    }

    public function invalidIdsData()
    {
        return [
            'exists' => [3],
            'not-exists' => [423]
        ];
    }
}
