<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    // トップページ
    public function index()
    {
        $user = Auth::user();
        $latestLog = WeightLog::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->first();

        $logs = WeightLog::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->paginate(8);

        $target = WeightTarget::where('user_id', $user->id)->first();


        return view('index', compact('logs', 'target', 'latestLog'));
    }

    // 体重登録
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);


        return redirect('/weight_logs');
    }

    // 体重検索
    public function search(Request $request)
    {
        $user = Auth::user();

        $query = WeightLog::where('user_id', $user->id);

        if ($request->from && $request->to) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }

        $latestLog = WeightLog::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->first();

        $logs = $query
            ->orderBy('date', 'desc')
            ->paginate(8)
            ->appends($request->query());

        $target = WeightTarget::where('user_id', $user->id)->first();

        return view('index', compact('logs', 'target', 'latestLog'))
            ->with([
                'request_from' => $request->from,
                'request_to'   => $request->to,
            ]);
    }

    // 体重詳細
    public function show($weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);
        return view('weight_logs.show', compact('log'));
    }

    // 体重更新
    public function update(Request $request, $weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);

        $log->update($request->only([
            'date',
            'weight',
            'calories',
            'exercise_time',
            'exercise_content'
        ]));

        return redirect('/weight_logs');
    }

    // 体重削除
    public function destroy($weightLogId)
    {
        WeightLog::findOrFail($weightLogId)->delete();
        return redirect('/weight_logs');
    }


    // 目標設定
    public function goalSetting()
    {
        $target = WeightTarget::where('user_id', Auth::id())->first();
        return view('weight_logs.goal_setting', compact('target'));
    }


    public function updateGoal(Request $request)
    {
        $target = WeightTarget::where('user_id', Auth::id())->first();
        $target->update([
            'target_weight' => $request->target_weight,
        ]);


        return redirect('/weight_logs');
    }
}
