<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TourListTest extends TestCase
{
    use RefreshDatabase;

    public function test_tours_list_by_travel_slug_returns_correct_tours(): void
    {

        $travel = Travel::factory()->create();
        $tour = Tour::factory()->create(['travel_id' => $travel->id]);

        $response = $this->get('api/v1/travels/' . $travel->slug . '/tours');

        $response->assertStatus(200);
        $response->assertJsonCount(count: 1, key: 'data');
        $response->assertJsonFragment(['id' => $tour->id]);
    }

    public function test_tour_price_is_shown_correctly(): void
    {
        $travel = Travel::factory()->create();
        Tour::factory()->create([
            'travel_id' => $travel->id,
             'price' => 123.45,
            ]);

        $response = $this->get('api/v1/travels/' . $travel->slug . '/tours');

        $response->assertStatus(200);
        $response->assertJsonCount(count: 1, key: 'data');
        $response->assertJsonFragment(['price' => '123.45']);
    }
}
