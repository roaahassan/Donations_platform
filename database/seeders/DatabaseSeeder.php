<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Donation;
use App\Models\Need;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DonationSeeder::class);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // احصل على أول مستخدم
        $user = User::first();

        // احصل على أول حاجة
        $need = Need::first();

        // تحقق من وجود مستخدم وحاجة
        if ($user && $need) {
            // أضف سجلات إلى جدول donations
            Donation::create([
                'user_id' => $user->id,
                'need_id' => $need->id,
                'amount' => 100.00, // مبلغ التبرع
                'status' => 'pending', // حالة التبرع
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Donation::create([
                'user_id' => $user->id,
                'need_id' => $need->id,
                'amount' => 200.00, // مبلغ التبرع
                'status' => 'confirmed', // حالة التبرع
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Donation::create([
                'user_id' => $user->id,
                'need_id' => $need->id,
                'amount' => 50.00, // مبلغ التبرع
                'status' => 'rejected', // حالة التبرع
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $this->command->info('لم يتم العثور على مستخدم أو حاجة. تأكد من وجود بيانات في جدول users وجدول needs.');
        }
    }
}
