<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $text = ["description" => substr(str_replace('.', '', $this->faker->unique()->text(100)), 0, 100)];
        return [
            'title' => substr(str_replace('.', '', $this->faker->unique()->text(25)), 0, 30),
            'job_group' => $this->faker->randomElement(["jg_1","jg_2","jg_3","jg_4","jg_5","jg_5","jg_6","jg_7","jg_8"]),
            'salary' => $this->faker->numberBetween(3, 4),
            'status' => $this->faker->randomElement(["open","close"]),
            'posted_by' => $this->faker->randomElement([1,3,4,5]),
            'meta' => json_encode($text)
        ];
    }
}