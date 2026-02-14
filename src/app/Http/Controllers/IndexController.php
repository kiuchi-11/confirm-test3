<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = WeightLog::where('user_id', $user->id)
                    ->orderBy('date', 'desc');

        // 検索
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('date', [
                $request->from,
                $request->to
            ]);
        }

        $weightLogs = $query->paginate(8)->withQueryString();

        $target = WeightTarget::where('user_id', $user->id)->first();

        $latestWeight = WeightLog::where('user_id', $user->id)
                            ->orderBy('date', 'desc')
                            ->value('weight');

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
}
