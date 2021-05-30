<?php

namespace App\Facades\Token;

use App\Enums\UserRoleEnum;
use App\Models\User;

/**
 * Class TokenClass
 * @package App\Facades\Token
 */
class TokenClass
{
    /**
     * @param User $user
     * @return string
     */
    public function createCustomerToken(User $user): string
    {
        $scope = [UserRoleEnum::CUSTOMER];

        return $user
            ->createToken('qc_auth_token', $scope)
            ->plainTextToken;
    }
}
