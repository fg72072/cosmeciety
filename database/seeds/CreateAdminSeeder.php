<?php

use App\User;
use App\Product;
use App\Category;
use App\DeliveryStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->assignRole('super-admin');

        $users = User::create([
            'name' => 'Seller',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $users->assignRole('seller');

        $users = User::create([
            'name' => 'Seller2',
            'email' => 'seller2@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $users->assignRole('seller');

        $users = User::create([
            'name' => 'Barber',
            'email' => 'barber@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $users->assignRole('barber');

        $users = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $users->assignRole('user');

        $category = new Category;
        $category->title = "Uncategorized";
        $category->status = "1";
        $category->save();

        for($i = 2;$i<= 3;$i++){
            $product = new Product;
            $product->user_id = $i;
            $product->cat_id = 1;
            $product->img = 'test';
            $product->title = 'test';
            $product->price = 5;
            $product->description = 'test';
            $product->status = '1';
            $product->save();
        }
        $status = [
            [
              "title"=> 'Pending',
            ],
            [
                "title"=> 'Confirm',
            ],
            [
                "title"=> 'Cancel',
            ],
            [
                "title"=> 'Delivered',
            ]
        ];
        foreach($status as $st){
            $delivery = new DeliveryStatus;
            $delivery->title = $st['title'];
            $delivery->save();
        }
    }
}
