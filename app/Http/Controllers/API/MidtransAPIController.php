<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMidtransAPIRequest;
use App\Http\Requests\API\UpdateMidtransAPIRequest;
use App\Models\Midtrans;
use App\Repositories\MidtransRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class MidtransController
 */

class MidtransAPIController extends AppBaseController
{
    private MidtransRepository $midtransRepository;

    public function __construct(MidtransRepository $midtransRepo)
    {
        $this->midtransRepository = $midtransRepo;
    }

    /**
     * @OA\Get(
     *      path="/midtrans",
     *      summary="getMidtransList",
     *      tags={"Midtrans"},
     *      description="Get all Midtrans",
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
     *                  @OA\Items(ref="#/components/schemas/Midtrans")
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
        $midtrans = $this->midtransRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($midtrans->toArray(), 'Midtrans retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/midtrans",
     *      summary="createMidtrans",
     *      tags={"Midtrans"},
     *      description="Create Midtrans",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Midtrans")
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
     *                  ref="#/components/schemas/Midtrans"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMidtransAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $midtrans = $this->midtransRepository->create($input);

        return $this->sendResponse($midtrans->toArray(), 'Midtrans saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/midtrans/{id}",
     *      summary="getMidtransItem",
     *      tags={"Midtrans"},
     *      description="Get Midtrans",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Midtrans",
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
     *                  ref="#/components/schemas/Midtrans"
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
        /** @var Midtrans $midtrans */
        $midtrans = $this->midtransRepository->find($id);

        if (empty($midtrans)) {
            return $this->sendError('Midtrans not found');
        }

        return $this->sendResponse($midtrans->toArray(), 'Midtrans retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/midtrans/{id}",
     *      summary="updateMidtrans",
     *      tags={"Midtrans"},
     *      description="Update Midtrans",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Midtrans",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Midtrans")
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
     *                  ref="#/components/schemas/Midtrans"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMidtransAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Midtrans $midtrans */
        $midtrans = $this->midtransRepository->find($id);

        if (empty($midtrans)) {
            return $this->sendError('Midtrans not found');
        }

        $midtrans = $this->midtransRepository->update($input, $id);

        return $this->sendResponse($midtrans->toArray(), 'Midtrans updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/midtrans/{id}",
     *      summary="deleteMidtrans",
     *      tags={"Midtrans"},
     *      description="Delete Midtrans",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Midtrans",
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
        /** @var Midtrans $midtrans */
        $midtrans = $this->midtransRepository->find($id);

        if (empty($midtrans)) {
            return $this->sendError('Midtrans not found');
        }

        $midtrans->delete();

        return $this->sendSuccess('Midtrans deleted successfully');
    }
}
