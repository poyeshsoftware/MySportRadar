<?php

namespace Tests\Feature;

use App\Sport;
use App\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TeamControllerTest extends TestCase
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
    public function testAdminCanUpdateTeam()
    {
        $team = Team::where('id', 1)->first();
        $sport = Sport::where('name', 'Football')->first();

        $data = [
            'name' => 'Durtmund',
            'sports' => [$sport->id]
        ];

        $this->patch(route('teams.update', $team->id), $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('teams', [
            'Name' => 'Durtmund',
        ]);
    }

    /**
     * @test
     */
    public function testAdminCanDeleteTeam()
    {
        $team = Team::where('name', 'Bayern Munich')->first();

        $this->delete(route('teams.delete', $team->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('teams', [
            'name' => 'Bayern Munich',
        ]);
    }

    /**
     * @test
     */
    public function testAdminCanMakeTeam()
    {
        $sport = Sport::where('name', 'Football')->first();

        $data = [
            'name' => 'New Castle',
            'sports' => [$sport->id]
        ];

        $this->post(route('teams'), $data)
            ->assertStatus(201);

        $this->assertDatabaseHas('teams', [
            'name' => 'New Castle',
        ]);
    }

    /**
     * @test
     */
    public function testTeamsJsonStructureIsTrue()
    {
        $response = $this->get('/api/teams');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'sports' => [
                        '*' => [
                            'id',
                            'name'
                        ]
                    ],
                ]
            ]
        ]);
        $response->assertSee('Bayern Munich');
        $response->assertSee('Manchester City');
        $response->assertSee('Boston Celtics');
        $response->assertSee('Houston Rockets');
        $response->assertSee('New York Empire');
        $response->assertSee('Chicago Smash');
    }
}
