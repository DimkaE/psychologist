<?php

namespace App\Services\Front;

use App\Http\Traits\Front\ScheduleTrait;
use App\Models\PsychologistPeriod;
use App\Models\User;
use Carbon\Carbon;

class SearchService
{
    use ScheduleTrait;

    public function filterByAge(?int $min, ?int $max): array
    {
        $users = User::query();
        if ($min) {
            $latest = new Carbon("-$min years");
            $users->where('birthdate', '<=', $latest);
        }
        if ($max) {
            $earliest = new Carbon("-$max years");
            $users->where('birthdate', '>=', $earliest);
        }
        return $users
            ->pluck('id')
            ->toArray();
    }

    public function filterByDate(string $date): array
    {
        $day = new Carbon($date);
        $ids = [];
        foreach (PsychologistPeriod::where([
            ['type', 'day'],
            ['number', day_of_week($day->dayOfWeek)]
        ])->get() as $psychologist_period) {
            $psychologist = User::find($psychologist_period->user_id);
            if ($this->availableTimes($psychologist, $day))
                $ids[] = $psychologist->id;
        }
        return $ids;
    }

    public function filterByTimes(array $times): array
    {
        return PsychologistPeriod::where([
            ['type', 'time'],
        ])
            ->whereIn('number', $times)
            ->pluck('user_id')
            ->toArray();
    }
}
