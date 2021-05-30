<?php

namespace Tests\Controllers\User;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class UserInfoTest
 * @package Tests\Controllers\User
 */
class UserInfoTest extends TestCase
{
    private string $url = '/api/v1.1/users/me';

    public function testUserInfoWithCustomerPermission(): void
    {
        Sanctum::actingAs(factory(User::class)->create(), [UserRoleEnum::CUSTOMER]);
        $response = $this->get($this->url)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ]);
        $response->assertOk();
    }

    public function testUserInfoWithWrongPermission(): void
    {
        Sanctum::actingAs(factory(User::class)->create(), [UserRoleEnum::GUEST]);
        $response = $this->get($this->url);
        $response->assertForbidden();
    }
}
