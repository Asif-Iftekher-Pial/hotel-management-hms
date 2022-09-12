<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Room;
use App\Models\Staff;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\RoomType;
use App\Models\Department;
use App\Models\RoomService;
use App\Models\StaffPayment;
use App\Models\RoomTypeImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        RoomService::factory(5)->create();
        RoomType::factory(10)->create();
        Room::factory(10)->create();
        Customer::factory(20)->create();
        RoomTypeImage::factory(30)->create();
        Department::factory(10)->create();
        Staff::factory(20)->create();
        StaffPayment::factory(20)->create();
        Booking::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'full_name' => 'Iftekher Pial',
        //     'email' => 'pial@example.com',
        //     'password'=>Hash::make('Pial7425'),
        //     'mobile' =>'01682824509',
        //     'address'   =>'ka-81/3, kha-para,Khilkhet,Dhaka',
        //     'photo' =>
        // ]);
    }
}
