<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWeightLogRequest;
use App\Http\Requests\UpdateWeightLogRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class WeightLogController extends Controller
{
    /**
     * 一覧 + 検索
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = WeightLog::where('user_id', $user->id)
                    ->orderBy('date', 'desc');

        // 期間検索
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }

        $weightLogs = $query->paginate(8)->onEachSide(1)->withQueryString();

        // 目標体重
        $target = WeightTarget::where('user_id', $user->id)->first();

        // 最新体重
        $latestWeight = WeightLog::where('user_id', $user->id)
                            ->orderBy('date', 'desc')
                            ->value('weight');

        // 差分
        $difference = null;
        if ($target && $latestWeight) {
            $difference = round($latestWeight - $target->target_weight, 1);
        }

        return view('weight_logs.index', compact(
            'weightLogs',
            'target',
            'latestWeight',
            'difference'
        ));
    }

    /**
     * 登録画面
     */
    public function create()
    {
        return view('weight_logs.create');
    }

    /**
     * 保存処理
     */
    public function store(StoreWeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index');
    }

    /**
     * 編集画面
     */
    public function edit($id)
    {
        $weightLog = WeightLog::where('user_id', auth()->id())
                        ->findOrFail($id);

        return view('weight_logs.edit', compact('weightLog'));
    }

    /**
     * 更新処理
     */
    public function update(StoreWeightLogRequest $request, WeightLog $weightLog)
    {
        if ($weightLog->user_id !== Auth::id()) {
            abort(403);
        }
        $weightLog->update($request->only([
            'date',
            'weight',
            'calories',
            'exercise_time',
            'exercise_content'
        ]));
        return redirect()->route('weight_logs.index');
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        $weightLog = WeightLog::where('user_id', auth()->id())
                        ->findOrFail($id);

        $weightLog->delete();

        return redirect()
            ->route('weight_logs.index')
            ->with('success', 'データを削除しました');
    }

    public function boot()
    {
        Paginator::useBootstrap();
    }
}