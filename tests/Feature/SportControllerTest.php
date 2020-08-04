<?php

namespace Tests\Feature;

use App\Sport;
use App\Team;
use App\TheEvent;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class SportControllerTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
        $admin = User::first();
        $this->actingAs($admin);
    }

    /**
     * @test
     */
    public function testAdminCanUpdateSport()
    {
        $sports = Sport::where('id', 1)->first();

        $data = [
            'name' => 'MyFootball'
        ];

        $this->patch(route('sports.update', $sports->id), $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('sports', $data);
    }

    /**
     * @test
     */
    public function testAdminCanDeleteSport()
    {
        $sport = Sport::where('id', 3)->first();

        $this->delete(route('sports.delete', $sport->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('sports', [
            'id' => 3,
        ]);
    }

    /**
     * @test
     */
    public function testAdminCanMakeSport()
    {

        $data = [
            'name' => 'Kick Boxing'
        ];

        $this->post(route('sports'), $data)
            ->assertStatus(201)
            ->assertJson($data);

        $this->assertDatabaseHas('sports', $data);
    }

    /**
     * @test
     */
    public function testSportsJsonStructureIsTrue()
    {
        $response = $this->get('/api/sports');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                ]
            ]
        ]);
        $response->assertSee('Football');
        $response->assertSee('Basketball');
        $response->assertSee('Tennis');
    }

}
