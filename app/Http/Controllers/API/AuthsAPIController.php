<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAuthsAPIRequest;
use App\Http\Requests\API\UpdateAuthsAPIRequest;
use App\Models\Auths;
use App\Repositories\AuthsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AuthsController
 */

class AuthsAPIController extends AppBaseController
{
    private AuthsRepository $authsRepository;

    public function __construct(AuthsRepository $authsRepo)
    {
        $this->authsRepository = $authsRepo;
    }

    /**
     * @OA\Get(
     *      path="/auths",
     *      summary="getAuthsList",
     *      tags={"Auths"},
     *      description="Get all Auths",
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
     *                  @OA\Items(ref="#/components/schemas/Auths")
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
        $auths = $this->authsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($auths->toArray(), 'Auths retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/auths",
     *      summary="createAuths",
     *      tags={"Auths"},
     *      description="Create Auths",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Auths")
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
     *                  ref="#/components/schemas/Auths"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAuthsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $auths = $this->authsRepository->create($input);

        return $this->sendResponse($auths->toArray(), 'Auths saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/auths/{id}",
     *      summary="getAuthsItem",
     *      tags={"Auths"},
     *      description="Get Auths",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Auths",
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
     *                  ref="#/components/schemas/Auths"
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
        /** @var Auths $auths */
        $auths = $this->authsRepository->find($id);

        if (empty($auths)) {
            return $this->sendError('Auths not found');
        }

        return $this->sendResponse($auths->toArray(), 'Auths retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/auths/{id}",
     *      summary="updateAuths",
     *      tags={"Auths"},
     *      description="Update Auths",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Auths",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Auths")
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
     *                  ref="#/components/schemas/Auths"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAuthsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Auths $auths */
        $auths = $this->authsRepository->find($id);

        if (empty($auths)) {
            return $this->sendError('Auths not found');
        }

        $auths = $this->authsRepository->update($input, $id);

        return $this->sendResponse($auths->toArray(), 'Auths updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/auths/{id}",
     *      summary="deleteAuths",
     *      tags={"Auths"},
     *      description="Delete Auths",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Auths",
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
        /** @var Auths $auths */
        $auths = $this->authsRepository->find($id);

        if (empty($auths)) {
            return $this->sendError('Auths not found');
        }

        $auths->delete();

        return $this->sendSuccess('Auths deleted successfully');
    }
}
