<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCommentRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * show details and comments by user
     * exits if user not found or invalid userid provided
     *
     * @param Request $request
     * @param int $userId
     * @return view
     */
    public function show(Request $request, $userId = null)
    {
        $userId = $request->input('id', $userId);
        if (!$userId) {
            die('User ID not found');
        }
        if (!$user = User::find($userId)) {
            die('User not found with id :' . $userId);
        }

        return view('welcome', compact('user'));
    }

    /**
     * store comment of an user
     *
     * @param UserCommentRequest $request
     * @return string
     */
    public function comments(UserCommentRequest $request)
    {
        $user = User::find($request->id);
        $user->comments .= "\n" . $request->comments;
        $user->save();

        return 'OK';
    }
}
