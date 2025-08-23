<?php

namespace App\Services\Api\v1;

use App\Classes\Api\v1\Dto\Posts\StorePostDto;
use App\Classes\Api\v1\Dto\Posts\UpdatePostDto;
use App\Models\Api\v1\Post;
use Illuminate\Support\Str;

/**
 * Clase que contiene funciones necesarias para gestionar posts
 */
class PostService
{
    /**
     * 
     */
    public function __construct() {}

    /**
     * Obtiene todos los posts
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function select()
    {
        return Post::orderBy('created_at', 'desc')
            ->paginate(4);
    }

    /**
     * Obtiene un post según el uuid
     * @param string $uuid uuid del post
     * @return Post|null
     */
    public function selectById(string $uuid)
    {
        return Post::find($uuid);
    }

    public function selectByUserId(string $uuid)
    {
        return Post::where('user_id', '=', $uuid)
            ->orderBy('created_at', 'desc')
            ->paginate(4);
    }

    /**
     * Crea un nuevo registro de post
     * 
     * @param \App\Classes\Api\v1\Dto\Posts\StorePostDto $dto Contiene los datos de un nuevo post
     * @return Post
     */
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

    /**
     * Guarda imagenes
     * @param array $images array de imagenes a guardar 
     * @param string $uuid uuid para identificar las imagenes
     * @param string $folder carpeta donde se guardaran las imagenes
     * @return array
     */
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

    /**
     * Genera un nuevo objeto post
     * @param \App\Classes\Api\v1\Dto\Posts\StorePostDto $dto Contiene los datos de un nuevo post
     * @return Post
     */
    private function createPost(StorePostDto $dto)
    {
        $post = new Post([
            'uuid' => Str::uuid()->toString(),
        ]);
        $post->fill($dto->all());

        return $post;
    }

    /**
     * Actualiza un post
     * @param \App\Classes\Api\v1\Dto\Posts\UpdatePostDto $dto Contiene los datos para actualizar un post
     * @param \App\Models\Api\v1\Post $post Post a actualizar
     * @return Post
     */
    public function update(UpdatePostDto $dto, Post $post)
    {
        $postUpdated = $this->updatePost($dto, $post);
        $postUpdated->save();
        return $postUpdated;
    }

    /**
     * Implementa los cambios de valores a un post existente
     * @param \App\Classes\Api\v1\Dto\Posts\UpdatePostDto $dto Contiene los datos para actualizar un post
     * @param \App\Models\Api\v1\Post $post Post a actualizar
     * @return Post
     */
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

    /**
     * Elimina un post
     * @param \App\Models\Api\v1\Post $post Post a eliminar
     * @return void
     */
    public function delete(Post $post)
    {
        $post->delete();
    }
}
