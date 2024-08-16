<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid;

trait Uuids
{
    /**
     * Boot Uuids Trait.
     */
    public static function bootUuids(): void
    {
        static::creating(fn ($model) => $model->uuid = Uuid::uuid4());
    }
}
