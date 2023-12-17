<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Profile;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(8);
        $roles = Role::all();
        $departments = Department::all();
        return view('admin.userAndRoles.employees', compact('users', 'roles', 'departments'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->department_id = $request->department;
        $user->save();

        return redirect()->route('users.index');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request)
    {
        $user = User::find($request->userId);
        $user->name = $request->nameEdit;
        $user->email = $request->emailEdit;
        $user->password = Hash::make($request->passwordEdit);
        $user->role_id = $request->roleEdit;
        $user->department_id = $request->departmentEdit;
        $user->save();

        return redirect()->route('users.index');
    }


    public function destroy(User $user)
    {
        //
    }

    public function showProfile(Request $request, $userId)
    {
        $profile = User::find($userId)->profile;
        return view('admin.userAndRoles.profile', compact('profile'));
    }

    public function storeProfile(Request $request, $userId)
    {
        $user = User::find($userId);

        $newPhoto = null;
        if ($user->profile != null)
            $path = $user->profile->image;
        if ($request->has('image')) {
            $image = $request->image;
            $newPhoto = time() . $image->getClientOriginalName();
            $image->move('profileImages/', $newPhoto);
            $path='profileImages/' . $newPhoto;
        }

        $profile = Profile::updateOrCreate(
            ['user_id' => $userId],
            [
                'address' => $request->address,
                'image' => $path,
            ]
        );

        $user->name = $request->name;
        $user->email = $request->email;
        if($user->password!=$request->password)
        $user->password = Hash::make($request->password) ;
        $user->save();

        return redirect()->route('transaction');
    }
}
