<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\App;
use App\Models\Mode;
use App\Models\User;
use App\Models\Drone;
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
        Mode::create(
            [
                'name' => 'manual'
            ]
        );
        Mode::create(
            [
                'name' => 'otomatis'
            ]
        );
        Mode::create(
            [
                'name' => 'hybrid'
            ]
        );
        Drone::create(
            [
                'id' => 'MKR2022',
                'merk' => 'DJI',
                'image' => '/images/drone/drone.png',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse aperiam veritatis dolore!'
            ]
        );
        User::create(
            [
                'name' => 'superuser',
                'email' => 'superuser@super.com',
                'password' => bcrypt('SuperUser999!')
            ]
        );
        App::create(
            [
                'name' => 'GCS',
                'version' => '1.0.0',
                'image' => 'images/app/logo.png',
                'description' => 'GROUND CONTROL SYSTEM'
            ]
        );
    }
}
