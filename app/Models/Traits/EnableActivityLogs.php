<?php

namespace App\Models\Traits;

use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait EnableActivityLogs
{
    use LogsActivity;

    /**
     * Get the activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Allow you to fill properties and add custom fields before the activity is saved.
     */
    public function tapActivity(Activity $activity, string $eventName): void
    {
        $activity->properties = $activity->properties->put(
            'ip_address',
            request()->ip()
        );

        if ($eventName === 'deleted') {
            $activity->properties = $activity->properties->put(
                'motive',
                request()->motive
            );
        }
    }
}
