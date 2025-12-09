<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSubCategoriesAPIRequest;
use App\Http\Requests\API\UpdateSubCategoriesAPIRequest;
use App\Models\SubCategories;
use App\Repositories\SubCategoriesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SubCategoriesController
 */

class SubCategoriesAPIController extends AppBaseController
{
    private SubCategoriesRepository $subCategoriesRepository;

    public function __construct(SubCategoriesRepository $subCategoriesRepo)
    {
        $this->subCategoriesRepository = $subCategoriesRepo;
    }

    /**
     * @OA\Get(
     *      path="/sub-categories",
     *      summary="getSubCategoriesList",
     *      tags={"SubCategories"},
     *      description="Get all SubCategories",
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
     *                  @OA\Items(ref="#/components/schemas/SubCategories")
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
        $subCategories = $this->subCategoriesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($subCategories->toArray(), 'Sub Categories retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/sub-categories",
     *      summary="createSubCategories",
     *      tags={"SubCategories"},
     *      description="Create SubCategories",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SubCategories")
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
     *                  ref="#/components/schemas/SubCategories"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSubCategoriesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $subCategories = $this->subCategoriesRepository->create($input);

        return $this->sendResponse($subCategories->toArray(), 'Sub Categories saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/sub-categories/{id}",
     *      summary="getSubCategoriesItem",
     *      tags={"SubCategories"},
     *      description="Get SubCategories",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SubCategories",
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
     *                  ref="#/components/schemas/SubCategories"
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
        /** @var SubCategories $subCategories */
        $subCategories = $this->subCategoriesRepository->find($id);

        if (empty($subCategories)) {
            return $this->sendError('Sub Categories not found');
        }

        return $this->sendResponse($subCategories->toArray(), 'Sub Categories retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/sub-categories/{id}",
     *      summary="updateSubCategories",
     *      tags={"SubCategories"},
     *      description="Update SubCategories",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SubCategories",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SubCategories")
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
     *                  ref="#/components/schemas/SubCategories"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSubCategoriesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SubCategories $subCategories */
        $subCategories = $this->subCategoriesRepository->find($id);

        if (empty($subCategories)) {
            return $this->sendError('Sub Categories not found');
        }

        $subCategories = $this->subCategoriesRepository->update($input, $id);

        return $this->sendResponse($subCategories->toArray(), 'SubCategories updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/sub-categories/{id}",
     *      summary="deleteSubCategories",
     *      tags={"SubCategories"},
     *      description="Delete SubCategories",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SubCategories",
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
        /** @var SubCategories $subCategories */
        $subCategories = $this->subCategoriesRepository->find($id);

        if (empty($subCategories)) {
            return $this->sendError('Sub Categories not found');
        }

        $subCategories->delete();

        return $this->sendSuccess('Sub Categories deleted successfully');
    }
}
