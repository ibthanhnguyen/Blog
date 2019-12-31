<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->paragraph,
        'content' => $faker->paragraph,
        'image' => $faker->image('public/storage/images',250,350, null, false),
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'category_id' => function () {
            return factory(App\Models\Category::class)->create()->id;
        },
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
