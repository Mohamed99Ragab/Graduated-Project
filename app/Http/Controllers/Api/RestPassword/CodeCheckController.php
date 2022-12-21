<?php

namespace App\Http\Controllers\Api\RestPassword;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;

class CodeCheckController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords,code',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response()->json(['message' => 'انتهت صلاحية رمز التحقق'], 422);
        }

        return response()->json([
            'code' => $passwordReset->code,
            'message' => 'رمز كود التحقق صالح'
        ], 200);
    }
}
