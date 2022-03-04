<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\UserRequest;
use App\Models\Consultation;
use App\Models\Payment;
use App\Models\User;
use App\Services\Back\UserService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends BackController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function index(Request $request)
    {
        $items = User::where($this->userService->filter($request))
            ->orderBy(
                $request->get('sort_col') ?: 'id',
                $request->get('sort_dir') ?: 'desc'
            )->paginate(50);
        return view('back.users.index', [
            'items' => $items,
            'request' => $request,
            'fields' => config('items.user_fields'),
        ]);
    }

    public function create()
    {
        return view('back.users.edit', [
            'item' => null,
            'fields' => config('items.user_fields'),
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = new User;
        $user->fill($request->validated());
        $user->password = Hash::make($request->get('password'));
        $user->save();
        $this->userService->updateImages($request, $user, 'avatar');
        return response()->redirect(route('back.users.edit', ['user' => $user->id]));
    }

    public function edit(User $user)
    {
        $fields = config('items.user_fields');
        if ($user->role == 2)
            $fields = array_merge(config('items.user_fields'), config('items.psychologist_fields'));
        return view('back.users.edit', [
            'item' => $user->load(['periodsRel', 'educationsRel', 'directionsRel']),
            'fields' => $fields,
            'unused' => Payment::where([
                ['user_id', $user->id],
                ['consultation_id', null],
            ])->count()
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->validatedExcept('password'));
        if ($request->get('password'))
            $user->password = Hash::make($request->get('password'));
        $user->save();
        $this->userService->updateImages($request, $user, 'avatar');
        return response()->success();
    }

    public function destroy(User $user)
    {
        if ($user->paymentsRel()->count())
            return response()->error('У пользователя есть платежи. Его нельзя удалить. Вместо этого вы можете его отключить');
        if ($user->consultationRel()->count())
            return response()->error('У пользователя есть записи о консультациях. Его нельзя удалить. Вместо этого вы можете его отключить');
        $user->delete();
        return response()->redirect(route('back.users.index'));
    }

    public function autocomplete(Request $request)
    {
        $str = $request->get('str');
        $items = User::where('name', 'like', '%' . $str . '%')
            ->orWhere('last_name', 'like', '%' . $str . '%')
            ->orWhere('email', 'like', '%' . $str . '%')
            ->take(5)
            ->get();
        $return = [];
        foreach ($items as $item) {
            array_push($return, [$item->id, $item->name_email]);
        }

        return response()->json($return);
    }
}
