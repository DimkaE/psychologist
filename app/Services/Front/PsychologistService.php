<?php

namespace App\Services\Front;

use App\Http\Requests\PsychologistRequest;
use App\Http\Traits\Front\ScheduleTrait;
use App\Models\Direction;
use App\Models\PsychologistDirection;
use App\Models\PsychologistEducation;
use App\Models\PsychologistPeriod;
use App\Models\User;

class PsychologistService
{
    use ScheduleTrait;

    public function updateRelations(PsychologistRequest $request, User $user)
    {
        $this->addImages($user, $request->file('diplomas'), 'diplomas');
        $this->addAvatar($user, $request->file('photo'));
        $this->addEducations($request->get('educations'), $user);
        $this->addEducations($request->get('educations_additional'), $user, false);
        $this->addDirections($request->get('directions'), $user);
        $this->addPeriods($request->get('periods_days'), $user, 'day');
        $this->addPeriods($request->get('periods_times'), $user, 'time');
    }

    public function addImages($item, $images, $collection)
    {
        if ($images) {
            foreach ($images as $photo) {
                $item->addMedia($photo)
                    ->toMediaCollection($collection);
            }
        }
    }

    public function addAvatar($item, $image)
    {
        if ($image) {
            $item->clearMediaCollection('avatar');
            $item->addMedia($image)
                ->toMediaCollection('avatar');
        }
    }

    public function addEducations(?array $educations, User $user, bool $primary = true)
    {
        if ($educations)
            foreach ($educations as $education) {
                $user->educationsRel()->save(
                    new PsychologistEducation([
                        'education' => $education,
                        'primary' => $primary
                    ])
                );
            }
    }

    public function addDirections(?array $directions, User $user)
    {
        if ($directions) {
            $user->directionsRel()->delete();
            foreach ($directions as $direction) {
                Direction::findOrFail($direction);
                $user->directionsRel()->save(
                    new PsychologistDirection(['direction_id' => $direction])
                );
            }
        }
    }

    public function addPeriods(?array $times, User $user, $type)
    {
        if ($times)
            foreach ($times as $time) {
                $user->periodsRel()->save(
                    new PsychologistPeriod([
                        'type' => $type,
                        'number' => $time
                    ])
                );
            }
    }
}
