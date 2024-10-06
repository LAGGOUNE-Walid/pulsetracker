<?php

namespace Tests\Feature;

use App\Models\App;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAppsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_getting_user_apps_api(): void
    {
        $user = User::factory()->has(App::factory()->count(3))->create();
        $response = $this->actingAs($user)->getJson("/api/apps");
        $response->assertJson(
            function (AssertableJson $json) {
                return  $json->has('meta')
                    ->has('links')
                    ->has('data', 3);
            }
        );
    }

    public function test_create_new_app_api(): void
    {
        Queue::fake();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson("/api/apps", [
            'name' => 'foo'
        ]);
        $response->assertJson(
            function (AssertableJson $json) {
                return  $json->has('data');
            }
        );
    }

    public function test_create_apps_out_of_quota_will_give_error(): void
    {
        Queue::fake();
        $user = User::factory()->create();
        $app1Response = $this->actingAs($user)->postJson("/api/apps", [
            'name' => 'foo'
        ]);
        $app2Response = $this->actingAs($user)->postJson("/api/apps", [
            'name' => 'foo'
        ]);
        $app1Response->assertStatus(201);
        $app2Response->assertStatus(Response::HTTP_FORBIDDEN);
    }

}
