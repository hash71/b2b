<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $images = [];
        array_push($images, $faker->imageUrl(300, 300));
        \App\User::create([
            'role' => 'admin',
            'email' => 'admin@admin.com',
            'approved' => 1,
            'password' => bcrypt("admin"),
            'type' => $faker->word,
            'company_name' => 'Admin',
            'category' => $faker->randomElement(\App\Category::lists('id')->toArray()),
            'contact_person' => $faker->word,
            'business_phone' => $faker->phoneNumber,
            'subscribe' => 1,
            'business_type' => $faker->word,
            'main_market' => $faker->word,
            'main_products' => $faker->word,
            'established_year' => $faker->year,
            'total_employee' => $faker->randomDigit,
            'capitalization' => $faker->word,
            'revenue' => $faker->numberBetween(1000, 10000000),
            'capital' => $faker->numberBetween(100000, 10000000),
            'ownership' => $faker->word,
            'sales_volume' => $faker->randomFloat(),
            'export_percent' => $faker->randomFloat(),
            'certifications' => $faker->word,
            'factory_location' => $faker->word,
            'factory_size' => $faker->randomDigit,
            'production_lines' => $faker->word,
            'production_capacity' => $faker->word,
            'purchase_volume' => $faker->randomDigitNotNull,
            'rd_stuff' => $faker->word,
            'qc_stuff' => $faker->word,
            'quality_control' => $faker->word,
            'contract_manufact' => $faker->word,
            'about_us' => $faker->sentence,
            'address' => $faker->address,
            'city' => $faker->city,
            'country' => $faker->country,
            'state' => $faker->city,
            'postal_code' => $faker->postcode,
            'telephone' => $faker->phoneNumber,
            'fax' => $faker->phoneNumber,
            'mobile' => $faker->phoneNumber,
            'website' => $faker->url,
            'verified_company' => $faker->boolean(),
            'gold_supplier' => $faker->boolean(),
            'premium_gold_supplier' => $faker->boolean(),
            'logo' => json_encode($images),
            'joined_at' => date("Y-m-d h:i:s", time()),
            'upgraded_at' => date("Y-m-d h:i:s", time())
        ]);
        for ($i = 1; $i <= 10; $i++) {
            $images = [];
            array_push($images, $faker->imageUrl(300, 300));
            \App\User::create([
                'role' => $faker->randomElement(['supplier', 'buyer', 'both']),
                'email' => $faker->email,
                'approved' => $faker->boolean(),
                'password' => bcrypt("1234"),
                'type' => $faker->word,
                'company_name' => $faker->word,
                'category' => $faker->randomElement(\App\Category::lists('id')->toArray()),
                'contact_person' => $faker->word,
                'business_phone' => $faker->phoneNumber,
                'subscribe' => 1,
                'business_type' => $faker->word,
                'main_market' => $faker->word,
                'main_products' => $faker->word,
                'established_year' => $faker->year,
                'total_employee' => $faker->randomDigit,
                'capitalization' => $faker->word,
                'revenue' => $faker->numberBetween(1000, 10000000),
                'capital' => $faker->numberBetween(100000, 10000000),
                'ownership' => $faker->word,
                'sales_volume' => $faker->randomFloat(),
                'export_percent' => $faker->randomFloat(),
                'certifications' => $faker->word,
                'factory_location' => $faker->word,
                'factory_size' => $faker->randomDigit,
                'production_lines' => $faker->word,
                'production_capacity' => $faker->word,
                'purchase_volume' => $faker->randomDigitNotNull,
                'rd_stuff' => $faker->word,
                'qc_stuff' => $faker->word,
                'quality_control' => $faker->word,
                'contract_manufact' => $faker->word,
                'about_us' => $faker->sentence,
                'address' => $faker->address,
                'city' => $faker->city,
                'country' => $faker->country,
                'state' => $faker->city,
                'postal_code' => $faker->postcode,
                'telephone' => $faker->phoneNumber,
                'fax' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
                'website' => $faker->url,
                'verified_company' => $faker->boolean(),
                'gold_supplier' => $faker->boolean(),
                'premium_gold_supplier' => $faker->boolean(),
                'logo' => json_encode($images),
                'joined_at' => date("Y-m-d h:i:s", time()),
                'upgraded_at' => date("Y-m-d h:i:s", time())
            ]);
        }

    }
}
