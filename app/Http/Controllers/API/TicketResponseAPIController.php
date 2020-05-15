<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTicketResponseAPIRequest;
use App\Http\Requests\API\UpdateTicketResponseAPIRequest;
use App\TicketResponse;
use App\Repositories\TicketResponseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TicketResponseController
 * @package App\Http\Controllers\API
 */

class TicketResponseAPIController extends AppBaseController
{
    /** @var  TicketResponseRepository */
    private $ticketResponseRepository;

    public function __construct(TicketResponseRepository $ticketResponseRepo)
    {
        $this->ticketResponseRepository = $ticketResponseRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/ticketResponses",
     *      summary="Get a listing of the TicketResponses.",
     *      tags={"TicketResponse"},
     *      description="Get all TicketResponses",
     *      produces={"application/json"},
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
     *                  @SWG\Items(ref="#/definitions/TicketResponse")
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
        $ticketResponses = $this->ticketResponseRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($ticketResponses->toArray(), 'Les réponses des tickets récupérées avec succès.');
    }

    /**
     * @param CreateTicketResponseAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/ticketResponses",
     *      summary="Store a newly created TicketResponse in storage",
     *      tags={"TicketResponse"},
     *      description="Store TicketResponse",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TicketResponse that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TicketResponse")
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
     *                  ref="#/definitions/TicketResponse"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTicketResponseAPIRequest $request)
    {
        $input = $request->all();

        $ticketResponse = $this->ticketResponseRepository->create($input);

        return $this->sendResponse($ticketResponse->toArray(), 'Réponse envoyée avec succès');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/ticketResponses/{id}",
     *      summary="Display the specified TicketResponse",
     *      tags={"TicketResponse"},
     *      description="Get TicketResponse",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TicketResponse",
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
     *                  ref="#/definitions/TicketResponse"
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
        /** @var TicketResponse $ticketResponse */
        $ticketResponse = $this->ticketResponseRepository->find($id);

        if (empty($ticketResponse)) {
            return $this->sendError('Réponse non trouvée.');
        }

        return $this->sendResponse($ticketResponse->toArray(), 'La réponse de ticket récupérée avec succès.');
    }

    /**
     * @param int $id
     * @param UpdateTicketResponseAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/ticketResponses/{id}",
     *      summary="Update the specified TicketResponse in storage",
     *      tags={"TicketResponse"},
     *      description="Update TicketResponse",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TicketResponse",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TicketResponse that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TicketResponse")
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
     *                  ref="#/definitions/TicketResponse"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTicketResponseAPIRequest $request)
    {
        $input = $request->all();

        /** @var TicketResponse $ticketResponse */
        $ticketResponse = $this->ticketResponseRepository->find($id);

        if (empty($ticketResponse)) {
            return $this->sendError(' Réponse non trouvée.');
        }

        $ticketResponse = $this->ticketResponseRepository->update($input, $id);

        return $this->sendResponse($ticketResponse->toArray(), 'Réponse mis à jour avec succès');
    }

  
   
}
