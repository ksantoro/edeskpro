<?php

    use App\Contact;
    use Faker\Generator as Faker;

    $factory->define(Contact::class, function (Faker $faker) {
        return [
            'contact_type_id' => 1,
            'first_name'      => $faker->firstName,
            'last_name'       => $faker->lastName,
            'title'           => $faker->title,
            'phone'           => $faker->phoneNumber,
            'phone_type_id'   => 1,
            'email'           => $faker->email,
            'email_type_id'   => 1,
        ];
    });
