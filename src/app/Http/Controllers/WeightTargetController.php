<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\WeightTarget;
use App\Http\Requests\UpdateWeightTargetRequest;

class WeightTargetController extends Controller
{
    public function edit()
    {
        $target = WeightTarget::where('user_id', Auth::id())->first();

        return view('weight_target.edit', compact('target'));
    }

    public function update(UpdateWeightTargetRequest $request)
    {
        $target = WeightTarget::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        $target->update([
            'target_weight' => $request->target_weight
        ]);

        return redirect()->route('weight_logs.index');
    }
}