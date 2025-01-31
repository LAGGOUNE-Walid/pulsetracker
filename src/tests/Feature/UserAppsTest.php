<?php

namespace Tests\Feature;

use App\Models\App;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Queue;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserAppsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_getting_user_apps_api(): void
    {
        Queue::fake();
        $user = User::factory()->has(App::factory()->count(3))->create();
        $response = $this->actingAs($user)->getJson('/api/apps');
        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('meta')
                    ->has('links')
                    ->has('data', 3);
            }
        );
    }

    public function test_create_new_app_api(): void
    {
        Queue::fake();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => 'foo',
        ]);
        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('data');
            }
        );
    }

    public function test_create_apps_out_of_quota_will_give_error(): void
    {
        Queue::fake();
        $user = User::factory()->create();
        $app1Response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => 'foo',
        ]);
        $app2Response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => 'foo',
        ]);
        $app1Response->assertStatus(Response::HTTP_CREATED);
        $app2Response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_deleting_app_will_reduce_quota(): void
    {
        Queue::fake();
        $user = User::factory()->create();
        $app1Response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => 'foo',
        ]);
        $app2Response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => 'foo',
        ]);
        $app1Response->assertStatus(Response::HTTP_CREATED);
        $app2Response->assertStatus(Response::HTTP_FORBIDDEN);

        $user->apps()->first()->delete();
        Queue::assertPushed('Pulse\\Jobs\\AppDeletedJob');
        $response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => 'foo',
        ]);
        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('data');
            }
        );
    }

    public function test_create_app_will_push_to_geopulse_queue(): void
    {
        Queue::fake();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => 'foo',
        ]);
        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('data');
            }
        );
        Queue::assertPushed('Pulse\Jobs\\AppCreatedJob');
    }

    public function test_app_create_validation(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => null,
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => '',
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response = $this->actingAs($user)->postJson('/api/apps', [
            'name' => ' ',
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_app_name(): void
    {
        Queue::fake();
        $user = User::factory()->has(App::factory()->count(3))->create();
        $response = $this->actingAs($user)->putJson('/api/apps/'.$user->apps()->first()->key, [
            'name' => 'buz',
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }
}
