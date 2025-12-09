<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSubCategoryAPIRequest;
use App\Http\Requests\API\UpdateSubCategoryAPIRequest;
use App\Models\SubCategory;
use App\Repositories\SubCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SubCategoryAPIController
 */
class SubCategoryAPIController extends AppBaseController
{
    private SubCategoryRepository $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepo)
    {
        $this->subCategoryRepository = $subCategoryRepo;
    }

    /**
     * Display a listing of the SubCategories.
     * GET|HEAD /sub-categories
     */
    public function index(Request $request): JsonResponse
    {
        $subCategories = $this->subCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($subCategories->toArray(), 'Sub Categories retrieved successfully');
    }

    /**
     * Store a newly created SubCategory in storage.
     * POST /sub-categories
     */
    public function store(CreateSubCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $subCategory = $this->subCategoryRepository->create($input);

        return $this->sendResponse($subCategory->toArray(), 'Sub Category saved successfully');
    }

    /**
     * Display the specified SubCategory.
     * GET|HEAD /sub-categories/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var SubCategory $subCategory */
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            return $this->sendError('Sub Category not found');
        }

        return $this->sendResponse($subCategory->toArray(), 'Sub Category retrieved successfully');
    }

    /**
     * Update the specified SubCategory in storage.
     * PUT/PATCH /sub-categories/{id}
     */
    public function update($id, UpdateSubCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SubCategory $subCategory */
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            return $this->sendError('Sub Category not found');
        }

        $subCategory = $this->subCategoryRepository->update($input, $id);

        return $this->sendResponse($subCategory->toArray(), 'SubCategory updated successfully');
    }

    /**
     * Remove the specified SubCategory from storage.
     * DELETE /sub-categories/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var SubCategory $subCategory */
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            return $this->sendError('Sub Category not found');
        }

        $subCategory->delete();

        return $this->sendSuccess('Sub Category deleted successfully');
    }
}
