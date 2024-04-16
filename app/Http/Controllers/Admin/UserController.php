<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::latest();
        if (!empty($request->get('keyword'))) {
            $users = $users->where('name', 'like', '%' . $request->get('keyword') . '%')
                ->orWhere('email', 'like', '%' . $request->get('keyword') . '%')
                ->orWhere('phone', 'like', '%' . $request->get('keyword') . '%');
        }
        $users = $users->paginate(10);

        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->save();

            $request->session()->flash('success', 'New user added successfully.');

            return response()->json([
                'status' => true,
                'message' => "New user added successfully."
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, string $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            $request->session()->flash('error', 'Record not found.');
            return redirect()->route('users.index');
        }
        return view('admin.user.edit', [
            'user' => $user
        ]);
        
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            $request->session()->flash('error', 'Record not found.');
            return redirect()->route('users.index');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id.',id',
        ]);

        if ($validator->passes()) {
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->password != '') {
                $user->password = Hash::make($request->password);
            }

            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->save();

            $request->session()->flash('success', 'User updated successfully.');

            return response()->json([
                'status' => true,
                'message' => "User updated successfully."
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy(Request $request, string $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            $request->session()->flash('error', 'Record not found.');
            return redirect()->route('users.index');
        }

        $user->delete();

        $request->session()->flash('success', 'User deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => "User deleted successfully."
        ]);
    }
}
