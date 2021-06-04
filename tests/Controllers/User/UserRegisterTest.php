<?php

namespace Tests\Controllers\User;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;
use Throwable;

/**
 * Class UserRegisterTest
 * @package Tests\Controllers\User
 */
class UserRegisterTest extends TestCase
{
    private string $url = '/api/v1.1/users/register';

    public function testUserRegisterWithValidToken(): void
    {
        $apiHeaderKey = config('api.header');
        $apiHeaderToken = hash_hmac('sha1', '', config('api.token'));
        $user = factory(User::class)->make([
            'id' => null,
        ]);
        $response = $this
            ->postJson(
                $this->url,
                [
                    "name" => $user->name,
                    "email" => $user->email,
                    "password" => $user->password,
                ],
                [
                    $apiHeaderKey => $apiHeaderToken,
                ]
            )
            ->assertCreated();
        try {
            $accessToken = $response->decodeResponseJson('access_token');
            $this->assertNotEmpty($accessToken);
        } catch (Throwable $e) {
            $this->fail();
        }
    }

    public function testUserRegisterWithoutToken(): void
    {
        $user = factory(User::class)->make([
            'id' => null,
        ]);
        $this
            ->postJson(
                $this->url,
                [
                    "name" => $user->name,
                    "email" => $user->email,
                    "password" => $user->password,
                ]
            )
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testUserRegisterWithInvalidToken(): void
    {
        $apiHeaderKey = config('api.header');
        $user = factory(User::class)->make([
            'id' => null,
        ]);
        $this
            ->postJson(
                $this->url,
                [
                    "name" => $user->name,
                    "email" => $user->email,
                    "password" => $user->password,
                ],
                [
                    $apiHeaderKey => config('api.token'),
                ]
            )
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
