<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Classes\Api\v1\ApiResponse;
use App\Models\Api\v1\Post;
use App\Services\Api\v1\PostService;
use App\Http\Requests\Api\v1\Posts\StorePostRequest;
use App\Http\Requests\Api\v1\Posts\UpdatePostRequest;
use App\Classes\Api\v1\Dto\Posts\StorePostDto;
use App\Classes\Api\v1\Dto\Posts\UpdatePostDto;
use App\Http\Resources\Api\v1\Posts\PostResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controlador para gestionar posts de usuarios
 */
class PostController extends Controller
{
    /**
     * Servicio encargado de manejar el crud de post
     * @var PostService
     */
    private PostService $postService;

    public function __construct()
    {
        $this->postService = new PostService();
    }

    /**
     * Obtiene y retorna todos los posts
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = $this->postService->select();

        return ApiResponse::response(
            true,
            null,
            [
                // 'posts' => PostResource::collection($posts)
                'posts' => $posts
            ]
        );
    }

    /**
     * Almacena un nuevo registro de post
     * @param \App\Http\Requests\Api\v1\Posts\StorePostRequest $request Request validado para almacenar un post
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(StorePostRequest $request)
    {
        $dto = StorePostDto::from($request->validated());
        
        $post = $this->postService->insert($dto);

        return ApiResponse::response(
            true,
            null,
            [
                'post' => new PostResource($post)
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Obtiene un post según su uuid
     * @param \App\Models\Api\v1\Post $post Post obtenido según uuid
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        return ApiResponse::response(
            true,
            null,
            [
                'post' => new PostResource($post)
            ],
        );
    }

    /**
     * Actualiza un post
     * @param \App\Http\Requests\Api\v1\Posts\UpdatePostRequest $request Request validado para actualizar el post
     * @param \App\Models\Api\v1\Post $post Post a actualizar
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $dto = UpdatePostDto::from($request->validated());
        $postUpdated = $this->postService->update($dto, $post);

        if (!$postUpdated) {
        }

        return ApiResponse::response(
            true,
            null,
            [
                'post' => new PostResource($postUpdated)
            ],
        );
    }

    /**
     * Elimina un post según uuid
     * @param \App\Models\Api\v1\Post $post Post a eliminar
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $this->postService->delete($post);

        return ApiResponse::response(
            true,
            null,
            null,
            Response::HTTP_NO_CONTENT
        );
    }
}
