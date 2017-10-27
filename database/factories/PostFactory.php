<?php
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->words(rand(2,5), true);
    // Формируем переменную для url
    $length = 100;
    $spaceSub = '_';
    //Ограничиваем строку до 100 символов, заменяем пробелы на подчеркивания и приводим строку к нижнему регистру//
    $code = mb_strtolower (str_replace(' ', $spaceSub,mb_strimwidth($title,0,$length)));
    return [
        'title' => $title,
        'preview_text' => $faker->text(150),
        'detail_text' => $faker->text(300),
        'code' => $code,
    ];
});