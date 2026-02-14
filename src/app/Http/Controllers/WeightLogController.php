<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeightLogRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $weightLogs = WeightLog::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        $target = WeightTarget::where('user_id', Auth::id())->first();

        return view('weight_logs.index', compact('weightLogs', 'target'));
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    public function store(WeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => Auth::id(),
            ...$request->validated(),
        ]);

        return redirect('/weight_logs');
    }

    public function show($weightLogId)
    {
        $weightLog = WeightLog::where('id', $weightLogId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('weight_logs.show', compact('weightLog'));
    }

    public function edit($weightLogId)
    {
        $weightLog = WeightLog::where('id', $weightLogId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('weight_logs.edit', compact('weightLog'));
    }

    public function update(WeightLogRequest $request, $weightLogId)
    {
        $weightLog = WeightLog::where('id', $weightLogId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $weightLog->update($request->validated());

        return redirect('/weight_logs/' . $weightLogId);
    }

    public function destroy($weightLogId)
    {
        $weightLog = WeightLog::where('id', $weightLogId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $weightLog->delete();

        return redirect('/weight_logs');
    }
    
}
