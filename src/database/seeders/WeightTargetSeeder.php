<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightTarget;
use App\Models\User;

class WeightTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrFail();

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => 50.0,
        ]);
    }
}
