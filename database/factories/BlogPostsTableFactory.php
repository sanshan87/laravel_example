<?php

use Faker\Generator as Faker;
use App\Models\BlogPost;

$factory->define(BlogPost::class, function (Faker $faker) {

    $title = $this->faker->sentence(rand(3, 8));
    $txt = $this->faker->realText(rand(1000, 4000));
    $isPublished = rand(1, 5) > 1;
    $createdAt = $this->faker->dateTimeBetween('-3 months', '-2 months');

    return [
        'category_id' => rand(1, 10),
        'user_id' => (rand(1, 5) == 5) ? 1 : 2,
        'title' => $title,
        'slug' => \Illuminate\Support\Str::slug($title),
        'excerpt' => $this->faker->text(rand(40, 100)),
        'content_raw' => $txt,
        'content_html' => $txt,
        'is_published' => $isPublished,
        'published_at' => $isPublished ? $this->faker->dateTimeBetween('-2 months', '-1 days') : null,
        'created_at' => $createdAt,
        'updated_at' => $createdAt
    ];
});
