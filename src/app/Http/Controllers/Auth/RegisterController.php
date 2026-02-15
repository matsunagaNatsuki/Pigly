<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterStep2Request;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('register.step2');
    }

    public function step()
    {
        return view('auth.register_step2');
    }

    public function setting(RegisterStep2Request $request)
    {
        $user = Auth::user();

        WeightLog::create([
            'user_id' => $user->id,
            'weight' => $request->weight,
            'date' => now(),
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $request->target_weight,
        ]);

        return redirect('/weight_logs');
    }
}