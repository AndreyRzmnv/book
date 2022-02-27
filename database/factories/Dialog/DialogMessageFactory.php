<?php

namespace Database\Factories\Dialog;

use App\Models\Dialog\DialogMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class DialogMessageFactory extends Factory
{
    protected $model = DialogMessage::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dialog_id' => 1,
            'user_id' => 1,
            'text' => $this->faker->realText,
        ];
    }
}
