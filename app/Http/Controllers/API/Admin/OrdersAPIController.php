<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateOrdersAPIRequest;
use App\Http\Requests\API\Admin\UpdateOrdersAPIRequest;
use App\Models\Admin\Orders;
use App\Repositories\Admin\OrdersRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class OrdersController
 */

class OrdersAPIController extends AppBaseController
{
    private OrdersRepository $ordersRepository;

    public function __construct(OrdersRepository $ordersRepo)
    {
        $this->ordersRepository = $ordersRepo;
    }

    /**
     * @OA\Get(
     *      path="/orders",
     *      summary="getOrdersList",
     *      tags={"Orders"},
     *      description="Get all Orders",
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
     *                  @OA\Items(ref="#/components/schemas/Orders")
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
        $orders = $this->ordersRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/orders",
     *      summary="createOrders",
     *      tags={"Orders"},
     *      description="Create Orders",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Orders")
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
     *                  ref="#/components/schemas/Orders"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrdersAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $orders = $this->ordersRepository->create($input);

        return $this->sendResponse($orders->toArray(), 'Orders saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/orders/{id}",
     *      summary="getOrdersItem",
     *      tags={"Orders"},
     *      description="Get Orders",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Orders",
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
     *                  ref="#/components/schemas/Orders"
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
        /** @var Orders $orders */
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            return $this->sendError('Orders not found');
        }

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/orders/{id}",
     *      summary="updateOrders",
     *      tags={"Orders"},
     *      description="Update Orders",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Orders",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Orders")
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
     *                  ref="#/components/schemas/Orders"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrdersAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Orders $orders */
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            return $this->sendError('Orders not found');
        }

        $orders = $this->ordersRepository->update($input, $id);

        return $this->sendResponse($orders->toArray(), 'Orders updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/orders/{id}",
     *      summary="deleteOrders",
     *      tags={"Orders"},
     *      description="Delete Orders",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Orders",
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
        /** @var Orders $orders */
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            return $this->sendError('Orders not found');
        }

        $orders->delete();

        return $this->sendSuccess('Orders deleted successfully');
    }
}
