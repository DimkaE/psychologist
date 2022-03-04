<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\PsychologistRequest;
use App\Jobs\PsychologistRegisteredJob;
use App\Models\Consultation;
use App\Models\Direction;
use App\Models\PsychologistPeriod;
use App\Models\User;
use App\Services\Front\PsychologistService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PsychologistController extends FrontController
{
    private PsychologistService $psychologistService;

    public function __construct()
    {
        $this->psychologistService = new PsychologistService;
    }

    public function register()
    {
        if (auth()->check())
            return redirect(route('account.data'));
        return view('front.psychologist.register', [
            'directions' => Direction::orderBy('name')->get(),
        ]);
    }

    public function store(PsychologistRequest $request)
    {
        $password = Str::random(8);
        $user = new User;
        $user->fill($request->validated());
        $user->role = User::ROLE_PSYCHOLOGIST;
        $user->password = Hash::make($password);
        $user->save();
        $this->psychologistService->updateRelations($request, $user);
        Auth::loginUsingId($user->id);
        PsychologistRegisteredJob::dispatchAfterResponse($password);
        return response()->success();
    }

    public function update(PsychologistRequest $request)
    {
        $user = auth()->user();
        $user->fill($request->validatedExcept('password'));
        if ($request->get('password'))
            $user->password = Hash::make($request->get('password'));
        $user->save();
        $user->educationsRel()->delete();
        $user->periodsRel()->delete();
        $this->psychologistService->updateRelations($request, $user);
        return response()->success();
    }

    public function destroy()
    {
        if ($this->psychologistService->getRecords())
            return response()->error('У вас есть запланированные сеансы. Сначала нужно их провести или отменить');
        $user = auth()->user();
        $user->email = 'deleted_' . $user->email;
        $user->enabled = 0;
        $user->published = 0;
        $user->save();
        auth()->logout();
        return response()->redirect(route('home'));
    }

    public function enable(Request $request)
    {
        $user = auth()->user();
        $user->enabled = $request->get('enabled');
        $a = 5;
        $user->save();
    }

}
