<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'seller_id'=>1, // seller_id=1 is admin
        'seller_name'=>'Admin',
        'name'=>$faker->sentence(3),
        'description'=>$faker->text(),
        'quantity'=>$faker->numberBetween(1,100),
        'price'=>$faker->numberBetween(5,200),
        'type'=>$faker->randomElement(['Electronics','Fashion','Home Appliances','Jewelry','Health and Beauty','Sports and Fitness']),
        'image'=>'placeholder-image.png',
    ];
});
