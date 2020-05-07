<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMissionAPIRequest;
use App\Http\Requests\API\UpdateMissionAPIRequest;
use App\Mission;
use App\Repositories\MissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MissionController
 * @package App\Http\Controllers\API
 */

class MissionAPIController extends AppBaseController
{
    /** @var  MissionRepository */
    private $missionRepository;

    public function __construct(MissionRepository $missionRepo)
    {
        $this->missionRepository = $missionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/missions",
     *      summary="Get a listing of the Missions.",
     *      tags={"Mission"},
     *      description="Get all Missions",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Mission")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $missions = $this->missionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($missions->toArray(), 'Missions retrieved successfully');
    }

    /**
     * @param CreateMissionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/missions",
     *      summary="Store a newly created Mission in storage",
     *      tags={"Mission"},
     *      description="Store Mission",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Mission that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Mission")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Mission"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMissionAPIRequest $request)
    {
        $input = $request->all();

        $mission = $this->missionRepository->create($input);

        return $this->sendResponse($mission->toArray(), 'Mission saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/missions/{id}",
     *      summary="Display the specified Mission",
     *      tags={"Mission"},
     *      description="Get Mission",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Mission",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Mission"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Mission $mission */
        $mission = $this->missionRepository->find($id);

        if (empty($mission)) {
            return $this->sendError('Mission not found');
        }

        return $this->sendResponse($mission->toArray(), 'Mission retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMissionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/missions/{id}",
     *      summary="Update the specified Mission in storage",
     *      tags={"Mission"},
     *      description="Update Mission",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Mission",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Mission that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Mission")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Mission"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMissionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Mission $mission */
        $mission = $this->missionRepository->find($id);

        if (empty($mission)) {
            return $this->sendError('Mission not found');
        }

        $mission = $this->missionRepository->update($input, $id);

        return $this->sendResponse($mission->toArray(), 'Mission updated successfully');
    }
}
