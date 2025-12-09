<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrder_ItemsAPIRequest;
use App\Http\Requests\API\UpdateOrder_ItemsAPIRequest;
use App\Models\Order_Items;
use App\Repositories\Order_ItemsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class Order_ItemsController
 */

class Order_ItemsAPIController extends AppBaseController
{
    private Order_ItemsRepository $orderItemsRepository;

    public function __construct(Order_ItemsRepository $orderItemsRepo)
    {
        $this->orderItemsRepository = $orderItemsRepo;
    }

    /**
     * @OA\Get(
     *      path="/order_-items",
     *      summary="getOrder_ItemsList",
     *      tags={"Order_Items"},
     *      description="Get all Order_Items",
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
     *                  @OA\Items(ref="#/components/schemas/Order_Items")
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
        $orderItems = $this->orderItemsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orderItems->toArray(), 'Order  Items retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/order_-items",
     *      summary="createOrder_Items",
     *      tags={"Order_Items"},
     *      description="Create Order_Items",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Order_Items")
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
     *                  ref="#/components/schemas/Order_Items"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrder_ItemsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $orderItems = $this->orderItemsRepository->create($input);

        return $this->sendResponse($orderItems->toArray(), 'Order  Items saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/order_-items/{id}",
     *      summary="getOrder_ItemsItem",
     *      tags={"Order_Items"},
     *      description="Get Order_Items",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Order_Items",
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
     *                  ref="#/components/schemas/Order_Items"
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
        /** @var Order_Items $orderItems */
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            return $this->sendError('Order  Items not found');
        }

        return $this->sendResponse($orderItems->toArray(), 'Order  Items retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/order_-items/{id}",
     *      summary="updateOrder_Items",
     *      tags={"Order_Items"},
     *      description="Update Order_Items",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Order_Items",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Order_Items")
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
     *                  ref="#/components/schemas/Order_Items"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrder_ItemsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Order_Items $orderItems */
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            return $this->sendError('Order  Items not found');
        }

        $orderItems = $this->orderItemsRepository->update($input, $id);

        return $this->sendResponse($orderItems->toArray(), 'Order_Items updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/order_-items/{id}",
     *      summary="deleteOrder_Items",
     *      tags={"Order_Items"},
     *      description="Delete Order_Items",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Order_Items",
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
        /** @var Order_Items $orderItems */
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            return $this->sendError('Order  Items not found');
        }

        $orderItems->delete();

        return $this->sendSuccess('Order  Items deleted successfully');
    }
}
