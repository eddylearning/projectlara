<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * seeders is used to add sample data
     * the data should follow db table formart
     */
    // public function run()
    // {
        //hardcoded data below
    //       Car::create([
    //     'title' => '2022 Toyota Corolla',
    //     'price' => 20500,
    //     'mileage' => 18000,
    //     'image_url' => 'https://via.placeholder.com/300x180?text=Toyota+Corolla',
    // ]);

    // Car::create([
    //     'title' => '2021 Honda Civic',
    //     'price' => 19300,
    //     'mileage' => 22000,
    //     'image_url' => 'https://via.placeholder.com/300x180?text=Honda+Civic',
    // ]);

    // Car::create([
    //     'title' => '2020 BMW 3 Series',
    //     'price' => 30990,
    //     'mileage' => 30000,
    //     'image_url' => 'https://via.placeholder.com/300x180?text=BMW+3+Series',
    // ]);

    // Car::create([
    //     'title' => '1960 Chevy Camaro',
    //     'price' => 50000,
    //     'mileage' => 65000,
    //     'image_url' => 'https://images.unsplash.com/photo-1618843473927-0cb7b9efbfa3?auto=format&fit=crop&w=300&q=80',
    // ]);



          //using factory to gen fack data and passing in seed so that goes to db
          // gen 100 fake cars
    // }
     
    public function run(){
        Car::factory()->count(50)->create();
    }
}
