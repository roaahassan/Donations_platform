<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;
use App\Models\User;
use App\Models\Need;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // احصل على أول مستخدم
        $need = Need::first(); // احصل على أول حاجة

        Donation::create([
            'user_id' => $user->id,
            'need_id' => $need->id,
            'status' => 'pending',
            'amount' => 100.00,
            'receipt' => 'path/to/receipt.jpg',
        ]);
    }
}
