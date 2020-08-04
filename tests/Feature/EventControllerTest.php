<?php

namespace Tests\Feature;

use App\Sport;
use App\Team;
use App\TheEvent;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class EventControllerTest extends TestCase
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
    public function testAdminCanUpdateEvent()
    {
        $event = TheEvent::where('id', 1)->first();
        $sport = Sport::where('name', 'Football')->first();
        $team1 = Team::where('name', 'Barcelona')->first();
        $team2 = Team::where('name', 'Manchester City')->first();

        $data = [
            'date' => '2020-08-15 20:00:00',
            '_sport_id' => $sport->id,
            '_team_id_1' => $team1->id,
            '_team_id_2' => $team2->id,
        ];

        $this->patch(route('events.update', $event->id), $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('the_events', $data);
    }

    /**
     * @test
     */
    public function testAdminCanDeleteEvent()
    {
        $event = TheEvent::where('_sport_id', 1)->where('_team_id_1', 3)->where('_team_id_2', 4)->first();

        $this->delete(route('events.delete', $event->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('the_events', [
            '_sport_id' => 1,
            '_team_id_1' => 3,
            '_team_id_2' => 4,
        ]);
    }

    /**
     * @test
     */
    public function testAdminCanMakeEvent()
    {

        $sport = Sport::where('name', 'Football')->first();
        $team1 = Team::where('name', 'Barcelona')->first();
        $team2 = Team::where('name', 'Manchester City')->first();

        $data = [
            'date' => '2020-08-15 20:00:00',
            '_sport_id' => $sport->id,
            '_team_id_1' => $team1->id,
            '_team_id_2' => $team2->id,
        ];

        $this->post(route('events'), $data)
            ->assertStatus(201)
            ->assertJson($data);

        $this->assertDatabaseHas('the_events', $data);
    }

    /**
     * @test
     */
    public function testEventsJsonStructureIsTrue()
    {
        $response = $this->get('/api/events');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'date',
                    'sport' => [
                        'id',
                        'name',
                    ],
                    'team_1' => [
                        'id',
                        'name'
                    ],
                    'team_2' => [
                        'id',
                        'name'
                    ],
                ]
            ]
        ]);
        $response->assertSee('Football');
        $response->assertSee('Basketball');
        $response->assertSee('Tennis');
        $response->assertSee('Bayern Munich');
        $response->assertSee('Manchester City');
        $response->assertSee('Real Madrid');
        $response->assertSee('Chicago Bulls');
        $response->assertSee('Orange County Breakers');
    }

    /**
     * @test
     */
    public function testEventsFilterBySportIdJsonStructureIsTrue()
    {
        $sport = Sport::where('name', 'Football')->first();
        self::assertEquals(1, $sport->id);

        $response = $this->get('/api/events?sport_id=' . $sport->id);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'date',
                    'sport' => [
                        'id',
                        'name',
                    ],
                    'team_1' => [
                        'id',
                        'name'
                    ],
                    'team_2' => [
                        'id',
                        'name'
                    ],
                ]
            ]
        ]);

        $response->assertStatus(200)
            ->assertSee('Football');
    }
}
