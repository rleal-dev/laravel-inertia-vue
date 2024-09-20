<?php

namespace App\Actions\AuthToken;

use App\Models\{AuthToken, User};
use Illuminate\Support\Facades\DB;

class CreateAuthToken
{
    /**
     * Create auth access token.
     */
    public function handle(User $user): int
    {
        return DB::transaction(function () use ($user): int {
            $token = random_int(10_000_000, 99_999_999);

            AuthToken::query()
                ->whereUserId($user->id)
                ->whereNull('verified_at')
                ->delete();

            AuthToken::create([
                'user_id' => $user->id,
                'token' => $token,
            ]);

            return $token;
        });
    }
}
