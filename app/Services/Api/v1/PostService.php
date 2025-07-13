<?php

namespace App\Services\Api\v1;

use App\Classes\Api\v1\Dto\Posts\StorePostDto;
use App\Classes\Api\v1\Dto\Posts\UpdatePostDto;
use App\Models\Api\v1\Post;
use Illuminate\Support\Str;

class PostService
{
    /**
     * 
     */
    public function __construct() {}

    public function select()
    {
        return Post::orderBy('created_at', 'desc')
            ->paginate(4);
    }

    public function selectById(string $uuid)
    {
        return Post::find($uuid);
    }

    public function insert(StorePostDto $dto): Post
    {
        $post = $this->createPost($dto);

        if ($dto->images) {
            $imagesUrl = $this->uploadImage($dto->images, $post->uuid, "/posts/images/$post->uuid");
            $post->images_url = $imagesUrl;
        }
        $post->save();

        return $post;
    }

    private function uploadImage(array $images, string $uuid, string $folder)
    {
        $fileService = new FileService();
        $imagesUrl = [];

        for ($i = 0; $i < count($images); $i++) {
            $filename = $fileService->generateFileName($uuid, $i + 1);
            $path = $fileService->upload($images[$i], $folder, $filename);
            array_push($imagesUrl, $path);
        }

        return $imagesUrl;
    }

    private function createPost(StorePostDto $dto)
    {
        $post = new Post([
            'uuid' => Str::uuid()->toString(),
        ]);
        $post->fill($dto->all());

        return $post;
    }

    public function update(UpdatePostDto $dto, Post $post)
    {
        $postUpdated = $this->updatePost($dto, $post);
        $postUpdated->save();
        return $postUpdated;
    }

    private function updatePost(UpdatePostDto $dto, Post $post)
    {
        $attributes = array_filter([
            'title' => $dto->title,
            'city' => $dto->city,
            'locality' => $dto->locality,
            'description' => $dto->description,
            'type' => $dto->type,
        ], fn($value) => !is_null($value));

        $post->fill($attributes);

        return $post;
    }


    public function delete(Post $post)
    {
        $post->delete();
    }
}
