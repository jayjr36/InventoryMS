<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserRole;

class UserController extends Controller
{

  public function index()
  {
    $users = User::all();
    return view('admin.users', compact('users'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|max:255',
      'email' => 'required',
      'role_id' => 'required|exists:user_roles,id',
    ]);

    try {

    } catch (\Exception $e) {

      return redirect()->route('users.index')->with('error', 'Failed to update user details. Please try again.');
    }
    $user = User::find($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->role_id = $request->input('role_id');
    $user->save();


    return redirect()->route('users.index')->with('success', 'Details updated successfully.');
  }

  public function destroy($id)
  {
    try {
      $user = User::find($id);
      $user->delete();
      return redirect()->route('users.index')->with('success', 'User deleted successfully');
    } catch (\Exception $e) {

      return redirect()->route('users.index')->with('error', 'Failed to delete user. Please try again.');
    }
  }

  public function show($id)
  {

    $user = User::find($id);
    return view('users.show', compact('user'));
  }

  public function edit($id)
  {
    try {
      $user = User::find($id);
      $roles = UserRole::all();
      return view('admin.editUser', compact('user', 'roles'));

    } catch (\Exception $e) {

      return redirect()->route('users.index')->with('error', 'Failed to edit user details. Please try again.');
    }
  }
  public function fetchUsers(Request $request)
  {
    try {
      // Retrieve all sessions from the database
      $users = User::all();
      $html = '<p class="display-5 text-center fw-bold">Sessions timetable</p>';
      $html .= '<div class="table-responsive">';
      $html .= '<table class="table table-bordered table-striped">';
      $html .= '<thead class="thead-dark"><tr><th>ID</th><th>Name</th><th>Email</th></tr></thead>';
      $html .= '<tbody>';

      foreach ($users as $user) {

        $html .= '<tr>';
        $html .= '<td>' . $user->id . '</td>';
        $html .= '<td>' . $user->name . '</td>';
        $html .= '<td>' . $user->email . '</td>';
        $html .= '<td>' . $user->role_id . '</td>';
        $html .= '</tr>';
      }

      $html .= '</tbody>';
      $html .= '</table>';
      $html .= '</div>';

      return response()->json(['html' => $html]);
    } catch (\Exception $e) {
      \Log::error('Error fetching users: ' . $e->getMessage());
      return response()->json(['error' => 'Internal Server Error'], 500);
    }
  }

}
