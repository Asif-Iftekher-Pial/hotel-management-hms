<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Room;
use App\Models\Staff;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\RoomType;
use App\Models\Department;
use App\Models\StaffPayment;
use App\Models\RoomTypeImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class
        ]);

        RoomType::factory(10)->create();
        Room::factory(20)->create();
        Customer::factory(20)->create();
        RoomTypeImage::factory(30)->create();
        Department::factory(10)->create();
        Staff::factory(20)->create();
        StaffPayment::factory(20)->create();
        Booking::factory(30)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
