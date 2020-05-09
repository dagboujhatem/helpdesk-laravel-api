<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMissionResponseAPIRequest;
use App\MissionResponse;
use App\Repositories\MissionResponseRepository;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MissionResponseController
 * @package App\Http\Controllers\API
 */

class MissionResponseAPIController extends AppBaseController
{
    /** @var  MissionResponseRepository */
    private $missionResponseRepository;

    public function __construct(MissionResponseRepository $missionResponseRepo)
    {
        $this->missionResponseRepository = $missionResponseRepo;
    }


    /**
     * @param CreateMissionResponseAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/missionResponses",
     *      summary="Store a newly created MissionResponse in storage",
     *      tags={"MissionResponse"},
     *      description="Store MissionResponse",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MissionResponse that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MissionResponse")
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
     *                  ref="#/definitions/MissionResponse"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMissionResponseAPIRequest $request)
    {
        $input = $request->all();

        $missionResponse = $this->missionResponseRepository->create($input);

        return $this->sendResponse($missionResponse->toArray(),
            'Réponse de la mission enregistrée avec succès.');
    }
}
