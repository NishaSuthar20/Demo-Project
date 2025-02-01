<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
  public function showUserListing(Request $request)
  {
    $user = User::get();

    if ($request->ajax()) {
        return DataTables::of($user)
            ->addIndexColumn()
            ->editColumn('user_name', function($model) {
                return $model->user_name;
            })
            ->editColumn('user_email', function($model) {
                return $model->user_email;
            })
            ->addColumn('action', function ($model) {
                return '<button class="edit_button" data-id="' . $model->id . '">Edit</button>
                        <button class="delete_button" data-id="' . $model->id . '">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
     return view('auth.userlisting');
  }
  public function getUsers()
{
    return response()->json(["data" => User::all()]);
}

  public function store(Request $request)
{
    $request->validate([
        'user_name' => 'required|string',
        'user_email' => 'required|email|unique:users,user_email',
    ]); // user validation

    User::create([
        'user_name' => $request->user_name,
        'user_email' => $request->user_email,

    ]);

    return response()->json(['message' => 'User added successfully!']);
}

public function delete($id) {
    $user = User::find($id);

    $user->delete();

    return response()->json(['User delete successfully']);
}

public function edit(Request $request, $id) {
    $user = User::findOrFail($id);

    $user->update([
        'user_name' => $request->user_name,
        'user_email' => $request->user_email,
    ]);

    return response()->json(['message' => 'User edited successfully']);
}

public function userData($id)
{
    $user = User::find($id);

    return response()->json([
        'user_name' => $user->user_name,
        'user_email' => $user->user_email
    ]);
}


}
