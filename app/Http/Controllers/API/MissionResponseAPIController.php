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
            'R??ponse de la mission enregistr??e avec succ??s.');
    }


    /**
     * @param CreateMissionResponseAPIRequest $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/missionResponses/confirmer/{id}",
     *      summary="Confirm the specified MissionResponse in storage",
     *      tags={"MissionResponse"},
     *      description="Confirm MissionResponse",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MissionResponse",
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
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function confirmer($id)
    {
        $missionResponse = $this->missionResponseRepository->find($id);

        if (empty($missionResponse)) {
            return $this->sendError('La r??ponse de mission est introuvable.');
        }
        // send mail notification here

        // update mission response
        $updatedMissionResponse = $this->missionResponseRepository->update(['isConfirmed' => true], $id);

        return $this->sendSuccess('La mission confirm??e avec succ??s, un mail est envoy?? au fournisseur concern??.');
    }
}
