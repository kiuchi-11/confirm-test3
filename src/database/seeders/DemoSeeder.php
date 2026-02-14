<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
        ]);

        WeightTarget::factory()->create([
            'user_id' => $user->id,
            'target_weight' => 60.0,
        ]);

        WeightLog::factory()
            ->count(35)
            ->create([
                'user_id' => $user->id,
            ]);
    }
}
