<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;

class RegisterController extends Controller
{
    public function step1()
    {
        return view('register_step1');
    }

    public function postStep1(RegisterStep1Request $request)
    {
        session([
            'register.name' => $request->name,
            'register.email' => $request->email,
            'register.password' => bcrypt($request->password),
        ]);

        return redirect()->route('register.step2');
    }


    public function step2()
    {
        if (!session('register.name')) {
            return redirect()->route('register.step1');
        }

        return view('register_step2');
    }


    public function postStep2(RegisterStep2Request $request)
    {
        $validated = $request->validated();
        $name = session('register.name');
        $email = session('register.email');
        $password = session('register.password');

        if (!$name || !$email || !$password) {
            return redirect()->route('register.step1')
                ->withErrors(['session' => '最初からやり直してください']);
        }

        DB::transaction(function () use ($name, $email, $password, $validated) {

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);

            WeightTarget::create([
                'user_id' => $user->id,
                'target_weight' => $validated['target_weight'],
            ]);

            $user->weightLogs()->create([
                'weight' => $validated['weight'],
                'date'   => now()->toDateString(),
            ]);
        });

        session()->forget('register');

        return redirect()->route('login')
            ->with('success', '登録が完了しました');
    }
}
