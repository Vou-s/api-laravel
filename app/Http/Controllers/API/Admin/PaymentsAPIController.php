<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreatePaymentsAPIRequest;
use App\Http\Requests\API\Admin\UpdatePaymentsAPIRequest;
use App\Models\Admin\Payments;
use App\Repositories\Admin\PaymentsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class PaymentsController
 */

class PaymentsAPIController extends AppBaseController
{
    private PaymentsRepository $paymentsRepository;

    public function __construct(PaymentsRepository $paymentsRepo)
    {
        $this->paymentsRepository = $paymentsRepo;
    }

    /**
     * @OA\Get(
     *      path="/payments",
     *      summary="getPaymentsList",
     *      tags={"Payments"},
     *      description="Get all Payments",
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
     *                  @OA\Items(ref="#/components/schemas/Payments")
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
        $payments = $this->paymentsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($payments->toArray(), 'Payments retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/payments",
     *      summary="createPayments",
     *      tags={"Payments"},
     *      description="Create Payments",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Payments")
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
     *                  ref="#/components/schemas/Payments"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePaymentsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $payments = $this->paymentsRepository->create($input);

        return $this->sendResponse($payments->toArray(), 'Payments saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/payments/{id}",
     *      summary="getPaymentsItem",
     *      tags={"Payments"},
     *      description="Get Payments",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Payments",
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
     *                  ref="#/components/schemas/Payments"
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
        /** @var Payments $payments */
        $payments = $this->paymentsRepository->find($id);

        if (empty($payments)) {
            return $this->sendError('Payments not found');
        }

        return $this->sendResponse($payments->toArray(), 'Payments retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/payments/{id}",
     *      summary="updatePayments",
     *      tags={"Payments"},
     *      description="Update Payments",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Payments",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Payments")
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
     *                  ref="#/components/schemas/Payments"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePaymentsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Payments $payments */
        $payments = $this->paymentsRepository->find($id);

        if (empty($payments)) {
            return $this->sendError('Payments not found');
        }

        $payments = $this->paymentsRepository->update($input, $id);

        return $this->sendResponse($payments->toArray(), 'Payments updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/payments/{id}",
     *      summary="deletePayments",
     *      tags={"Payments"},
     *      description="Delete Payments",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Payments",
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
        /** @var Payments $payments */
        $payments = $this->paymentsRepository->find($id);

        if (empty($payments)) {
            return $this->sendError('Payments not found');
        }

        $payments->delete();

        return $this->sendSuccess('Payments deleted successfully');
    }
}
