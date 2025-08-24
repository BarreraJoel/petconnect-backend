<?php

namespace Database\Factories\Api\v1;

use App\Enums\Api\v1\PostTypeEnum;
use App\Models\Api\v1\Post;
use App\Models\Api\v1\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\v1\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userUuidArray = User::pluck('uuid')->toArray();

        return [
            'uuid' => $this->faker->uuid(),
            'type' => $this->faker->randomElement(PostTypeEnum::toArray()),
            'title' => $this->faker->words(2, true),
            'city' => $this->faker->city(),
            'locality' => $this->faker->city(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->realText(100),
            'is_approved' => $this->faker->boolean(),
            'user_uuid' => $this->faker->randomElement($userUuidArray),
        ];
    }
}
