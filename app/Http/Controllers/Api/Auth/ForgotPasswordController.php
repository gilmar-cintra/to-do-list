<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ForgotPasswordRequest $request)
    {
        $data = $request->validated();

        Password::sendResetLink(['email' => $data['email']]);

        return response()->json([
            'message' => 'Link to reset password sent.',
        ]);
    }
}
