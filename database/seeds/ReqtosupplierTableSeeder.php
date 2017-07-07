<?php

use App\Message;
use Illuminate\Database\Seeder;

class ReqtosupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $suppliers = \App\User::where('approved', 1)
            ->where(function ($query) {
                $query->where('role', 'supplier')
                    ->orWhere('role', 'both');
            })->lists('id')->toArray();

        $buyers = \App\User::where('approved', 1)
            ->where(function ($query) {
                $query->where('role', 'buyer')
                    ->orWhere('role', 'both');
            })->lists('id')->toArray();

        for ($i = 1; $i <= 500; $i++) {
            $approved = $faker->boolean();
            \App\ReqToSupplier::unguard();
            $images = [];
            array_push($images, $faker->imageUrl(300, 300));
            $data = \App\ReqToSupplier::create([
                'supplier' => $faker->randomElement($suppliers),
                'buyer' => $faker->randomElement($buyers),
                'subject' => $faker->word,
                'message' => $faker->sentence(),
                'response_required_time' => $faker->time(),
                'additional' => json_encode($faker->randomElements(['a', 'b', 'c', 'd', 'e', 'f'], 3)),
                'images' => json_encode($images),
                'approved' => $approved
            ]);
            \App\ReqToSupplier::reguard();
            Message::unguard();
            Message::create([
                'from' => $data->buyer,
                'to' => $data->supplier,
                'req_id' => $data->id,
                'approved' => $faker->boolean(),
                'type' => 'reqtosupplier',
                'new' => $faker->boolean(),
                'approved' => $approved
            ]);
            Message::reguard();
        }

    }
}
