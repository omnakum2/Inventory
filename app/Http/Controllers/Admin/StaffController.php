<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StaffController extends Controller
{
    public function index(){
        $user = User::where('role_as',0)->get();
        return view('admin.staff.index',compact('user'));
    }
    public function add(){
        return view('admin.staff.add');
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::min(8)->numbers()->mixedCase()->symbols()],
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('admin/staff')->with('msg', 'Staff Added!!!');
    }

    public function edit($id){
        $user = User::where('id', $id)->first();
        return view('admin.staff.edit',["user"=> $user]);
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('admin/staff')->with('msg', 'Staff Updated!!!');
    }
}
