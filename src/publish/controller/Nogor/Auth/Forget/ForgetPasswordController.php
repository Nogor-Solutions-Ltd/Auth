<?php

namespace App\Http\Controllers\Nogor\Auth\Forget;

use App\Models\Member;
use App\Mail\ResetMail;
use Illuminate\Http\Request;
use App\Action\Auth\EmailAction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    /**
     * Password reset request store.
     *
     * @return View
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:191',
            'model' => 'required'
        ];

        $request->validate($rules);

        $user = DB::table('users')->where('email', $request->email)->first();

        if (empty($user)) {
            return back()->with('error', 'Email not found!');
        }

        $layout = "reset";
        Mail::to($request->email)->send(new ResetMail($user, $layout));

        return back()->with('success', 'Password reset email sent. Please check your inbox and follow the instructions.');
    }
}
