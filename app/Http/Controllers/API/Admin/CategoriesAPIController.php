<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateCategoriesAPIRequest;
use App\Http\Requests\API\Admin\UpdateCategoriesAPIRequest;
use App\Models\Admin\Categories;
use App\Repositories\Admin\CategoriesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CategoriesController
 */

class CategoriesAPIController extends AppBaseController
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepo)
    {
        $this->categoriesRepository = $categoriesRepo;
    }

    /**
     * @OA\Get(
     *      path="/categories",
     *      summary="getCategoriesList",
     *      tags={"Categories"},
     *      description="Get all Categories",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Categories")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $categories = $this->categoriesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/categories",
     *      summary="createCategories",
     *      tags={"Categories"},
     *      description="Create Categories",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Categories")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Categories"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCategoriesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $categories = $this->categoriesRepository->create($input);

        return $this->sendResponse($categories->toArray(), 'Categories saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/categories/{id}",
     *      summary="getCategoriesItem",
     *      tags={"Categories"},
     *      description="Get Categories",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Categories",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Categories"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id): JsonResponse
    {
        /** @var Categories $categories */
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            return $this->sendError('Categories not found');
        }

        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/categories/{id}",
     *      summary="updateCategories",
     *      tags={"Categories"},
     *      description="Update Categories",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Categories",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Categories")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Categories"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCategoriesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Categories $categories */
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            return $this->sendError('Categories not found');
        }

        $categories = $this->categoriesRepository->update($input, $id);

        return $this->sendResponse($categories->toArray(), 'Categories updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/categories/{id}",
     *      summary="deleteCategories",
     *      tags={"Categories"},
     *      description="Delete Categories",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Categories",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id): JsonResponse
    {
        /** @var Categories $categories */
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            return $this->sendError('Categories not found');
        }

        $categories->delete();

        return $this->sendSuccess('Categories deleted successfully');
    }
}
