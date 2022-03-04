<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\CustomerRequest;
use App\Jobs\PsychologistRegisteredJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends FrontController
{
    public function store(CustomerRequest $request)
    {
        $password = Str::random(8);
        $user = new User;
        $user->fill($request->validated());
        $user->role = User::ROLE_CUSTOMER;
        $user->password = Hash::make($password);
        $user->save();
        Auth::loginUsingId($user->id);
        PsychologistRegisteredJob::dispatchAfterResponse($password);
        return response()->success($user);
    }

    public function update(CustomerRequest $request)
    {
        $user = auth()->user();
        $user->fill($request->validatedExcept('password'));
        if ($request->get('password'))
            $user->password = Hash::make($request->get('password'));
        $user->save();
        return response()->success();
    }

    public function destroy()
    {

        $user = auth()->user();
        if ($user->consultationRel()->active()->count())
            return response()->error('У вас есть запланированные сеансы. Сначала нужно их провести или отменить');
        $user->email = 'deleted_' . $user->email;
        $user->save();
        auth()->logout();
        return response()->redirect(route('home'));
    }
}
