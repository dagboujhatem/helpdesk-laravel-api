<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTicketResponseAPIRequest;
use App\Http\Requests\API\UpdateTicketResponseAPIRequest;
use App\Repositories\TicketRepository;
use App\Ticket;
use App\TicketResponse;
use App\Repositories\TicketResponseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Storage;
use Response;

/**
 * Class TicketResponseController
 * @package App\Http\Controllers\API
 */

class TicketResponseAPIController extends AppBaseController
{
    /** @var  TicketResponseRepository */
    private $ticketResponseRepository;
    /** @var  TicketRepository */
    private $ticketRepository;

    public function __construct(TicketResponseRepository $ticketResponseRepo, TicketRepository $ticketRepo)
    {
        $this->ticketResponseRepository = $ticketResponseRepo;
        $this->ticketRepository = $ticketRepo;
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
     *      security = {{"Bearer": {}}},
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

        // upload file
        if($request->hasFile('file')){
            $path = $request->file('file')->store('tickets-response');
            $input['file'] = Storage::url($path);
        }

        $ticketResponse = $this->ticketResponseRepository->create($input);

        // update ticket
        /** @var Ticket $ticket */
        $ticket = $this->ticketRepository->find($input['ticket_id']);
        if (empty($ticket)) {
            return $this->sendError('Ticket introuvable.');
        }

        // update etat en
        $dateToday = new Carbon();
        $date_echeance = Carbon::parse($ticket->date_d_echeance)->format('Y-m-d H:m');
        if ($dateToday > $date_echeance)
        {  // update l'etat en retard
            $ticket = $this->ticketRepository->update(['etat'=> 'En retard'], $input['ticket_id']);
        } else {
            // update l'etat en Clos
            $ticket = $this->ticketRepository->update(['etat'=> 'Clos'], $input['ticket_id']);
        }

        return $this->sendResponse($ticketResponse->toArray(),
            'Réponse ajouté avec succès.');
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
     *      security = {{"Bearer": {}}},
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

        return $this->sendResponse($ticketResponse->toArray(),
            'La réponse de ticket récupérée avec succès.');
    }



}
