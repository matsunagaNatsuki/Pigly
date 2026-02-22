<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class WeightTargetController extends Controller
{
    // 目標設定
    public function goalSetting()
    {
        $target = WeightTarget::where('user_id', Auth::id())->first();
        return view('target', compact('target'));
    }


    public function updateGoal(Request $request)
    {
        $target = WeightTarget::firstOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => 0]
        );

        $target->update([
            'target_weight' => $request->target_weight,
        ]);

        return redirect('/weight_logs');
    }
}
