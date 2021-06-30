<?php

namespace Database\Factories;

use App\Models\commnet;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>$this->faker->name ,
            'body' => $this->faker->realText(350),
            'created_at' =>$this->faker->dateTimeBetween('-2 months')

        ];
    }
}
