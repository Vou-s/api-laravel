<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductsAPIRequest;
use App\Http\Requests\API\UpdateProductsAPIRequest;
use App\Models\Products;
use App\Repositories\ProductsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProductsController
 */

class ProductsAPIController extends AppBaseController
{
    private ProductsRepository $productsRepository;

    public function __construct(ProductsRepository $productsRepo)
    {
        $this->productsRepository = $productsRepo;
    }

    /**
     * @OA\Get(
     *      path="/products",
     *      summary="getProductsList",
     *      tags={"Products"},
     *      description="Get all Products",
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
     *                  @OA\Items(ref="#/components/schemas/Products")
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
        $products = $this->productsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($products->toArray(), 'Products retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/products",
     *      summary="createProducts",
     *      tags={"Products"},
     *      description="Create Products",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Products")
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
     *                  ref="#/components/schemas/Products"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $products = $this->productsRepository->create($input);

        return $this->sendResponse($products->toArray(), 'Products saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/products/{id}",
     *      summary="getProductsItem",
     *      tags={"Products"},
     *      description="Get Products",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Products",
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
     *                  ref="#/components/schemas/Products"
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
        /** @var Products $products */
        $products = $this->productsRepository->find($id);

        if (empty($products)) {
            return $this->sendError('Products not found');
        }

        return $this->sendResponse($products->toArray(), 'Products retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/products/{id}",
     *      summary="updateProducts",
     *      tags={"Products"},
     *      description="Update Products",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Products",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Products")
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
     *                  ref="#/components/schemas/Products"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Products $products */
        $products = $this->productsRepository->find($id);

        if (empty($products)) {
            return $this->sendError('Products not found');
        }

        $products = $this->productsRepository->update($input, $id);

        return $this->sendResponse($products->toArray(), 'Products updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/products/{id}",
     *      summary="deleteProducts",
     *      tags={"Products"},
     *      description="Delete Products",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Products",
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
        /** @var Products $products */
        $products = $this->productsRepository->find($id);

        if (empty($products)) {
            return $this->sendError('Products not found');
        }

        $products->delete();

        return $this->sendSuccess('Products deleted successfully');
    }
}
