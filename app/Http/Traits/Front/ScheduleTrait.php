<?php

namespace App\Http\Traits\Front;

use App\Models\Consultation;
use App\Models\User;
use Carbon\Carbon;

trait ScheduleTrait
{
    public function availableDates(User $psychologist): array
    {
        $dates = [];
        for ($i = 0; $i < config('app.max_record_days'); $i++) {
            $day = new Carbon('+' . $i . 'days');
            if (in_array(day_of_week($day->dayOfWeek), $psychologist->periods_days)) {
                if ($this->availableTimes($psychologist, $day))
                    $dates[] = $day->format('Y-m-d');
            }
        }
        return $dates;
    }

    public function availableTimes(User $psychologist, $day): array
    {
        $now = new Carbon('-1 hour');
        $periods_times = $psychologist->periods_times;
        $times = [];
        foreach ($periods_times as $time) {
            if (!Consultation::where([
                ['psychologist_id', $psychologist->id],
                ['datetime', $day->format('Y-m-d') . ' ' . $time . ':00:00'],
            ])
                ->active()
                ->count()) {
                if ($day->format('Y-m-d') == $now->format('Y-m-d')) {
                    if ($time > $now->format('H'))
                        $times[] = $time;
                } else {
                    $times[] = $time;
                }
            }
        }
        return $times;
    }

    public function availableDateTimes(User $psychologist): array
    {
        $datetimes = [];
        $dates = $this->availableDates($psychologist);
        foreach ($dates as $date) {
            $times = $this->availableTimes($psychologist, new Carbon($date));
            foreach ($times as $time) {
                $datetimes[] = $date . ' ' . $time . ':00:00';
            }
        }
        $a = 5;
        return $datetimes;
    }

    public function getRecords($finished = false)
    {
        if (auth()->user()->role == User::ROLE_PSYCHOLOGIST) {
            $query = Consultation::where('psychologist_id', auth()->id())
                ->with('client');
        } else {
            $query = Consultation::where('client_id', auth()->id())
                ->with('psychologist');
        }
        $query->orderBy('datetime');
        $operator = $finished ? '<' : '>';
        return $query->where('datetime', $operator, new Carbon())->get();
    }
}
