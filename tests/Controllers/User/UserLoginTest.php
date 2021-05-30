<?php

namespace Tests\Controllers\User;

use App\Models\User;
use Tests\TestCase;
use Throwable;

/**
 * Class UserLoginTest
 * @package Tests\Controllers\User
 */
class UserLoginTest extends TestCase
{
    private string $url = '/api/v1.1/users/login';

    public function testUserCanLogin(): void
    {
        $apiHeaderKey = config('api.header');
        $apiHeaderToken = hash_hmac('sha1', '', config('api.token'));
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);
        $response = $this
            ->postJson(
                $this->url,
                [
                    'email' => $user->email,
                    'password' => 'i-love-laravel',
                ],
                [
                    $apiHeaderKey => $apiHeaderToken,
                ]
            );
        try {
            $accessToken = $response->decodeResponseJson('access_token');
            $this->assertNotEmpty($accessToken);
            $this->assertAuthenticatedAs($user);
        } catch (Throwable $e) {
            $this->fail();
        }
    }

    public function testUserCannotLogin(): void
    {
        $apiHeaderKey = config('api.header');
        $apiHeaderToken = hash_hmac('sha1', '', config('api.token'));
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);
        $this
            ->postJson(
                $this->url,
                [
                    'email' => $user->email,
                    'password' => 'i-love-symfony',
                ],
                [
                    $apiHeaderKey => $apiHeaderToken,
                ]
            )
            ->assertUnauthorized();
    }
}
