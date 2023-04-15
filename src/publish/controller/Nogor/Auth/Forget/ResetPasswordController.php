<?php

namespace App\Http\Controllers\Nogor\Auth\Forget;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /**
     * Password reset store.
     *
     * @return View
     */
    public function store(Request $request)
    {
        $rule = [
            'password' => 'required|min:6|max:20|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6|max:20',
            '_uid' => 'required',
        ];

        $request->validate($rule);

        $reset = DB::table('password_reset_tokens')
            ->where('token', $request->_uid)
            ->first();

        if (empty($reset)) {
            return back()->with('error', 'Token Expired !');
        }

        $user = DB::table($request->model)->where('email', $reset->email)->first();

        if (empty($user)) {
            return back()->with('error', 'Sorry, User not found !');
        }

        DB::table($request->model)
            ->where('email', $reset->email)
            ->update(['password' => bcrypt($request->password)]);

        # Delete the reset token.
        DB::table('password_reset_tokens')
            ->where('token', $request->_uid)
            ->delete();

        return back()->with('success', 'Password changed !');
    }
}
