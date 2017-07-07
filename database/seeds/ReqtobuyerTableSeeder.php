<?php

use App\Message;
use Illuminate\Database\Seeder;

class ReqtobuyerTableSeeder extends Seeder
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
            \App\ReqToBuyer::unguard();
            $images = [];
            array_push($images, $faker->imageUrl(300, 300));
            $data = \App\ReqToBuyer::create([
                'supplier' => $faker->randomElement($suppliers),
                'buyer' => $faker->randomElement($buyers),
                'message' => $faker->sentence,
                'additional' => json_encode($faker->randomElements(['a', 'b', 'c', 'd', 'e', 'f'], 3)),
                'supply_ability' => $faker->word,
                'approved' => $approved,
                'images' => json_encode($images)
            ]);
            \App\ReqToBuyer::reguard();
            Message::unguard();
            Message::create([
                'from' => $data->supplier,
                'to' => $data->buyer,
                'req_id' => $data->id,
                'approved' => $approved,
                'type' => 'reqtobuyer',
                'new' => $faker->boolean()
            ]);
            Message::reguard();
        }
    }
}
