<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Requests\API\UpdateTicketAPIRequest;
use App\Http\Requests\API\UpdateTicketPrioriteAPIRequest;
use App\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Storage;
use Response;

/**
 * Class TicketController
 * @package App\Http\Controllers\API
 */

class TicketAPIController extends AppBaseController
{
    /** @var  TicketRepository */
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepo)
    {
        $this->ticketRepository = $ticketRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/tickets",
     *      summary="Get a listing of the Tickets.",
     *      tags={"Ticket"},
     *      description="Get all Tickets",
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
     *                  @SWG\Items(ref="#/definitions/Ticket")
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
        $tickets = $this->ticketRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tickets->toArray(), 'Tickets récupérées avec succès.');
    }

    /**
     * @param CreateTicketAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/tickets",
     *      summary="Store a newly created Ticket in storage",
     *      tags={"Ticket"},
     *      description="Store Ticket",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ticket that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Ticket")
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
     *                  ref="#/definitions/Ticket"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTicketAPIRequest $request)
    {
        $input = $request->all();

        // upload file
        if($request->hasFile('file')){
            $path = $request->file('file')->store('tickets');
            $input['file'] = Storage::url($path);
        }

        $ticket = $this->ticketRepository->create($input);

        return $this->sendResponse($ticket->toArray(), 'Ticket enregistré avec succès.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/tickets/{id}",
     *      summary="Display the specified Ticket",
     *      tags={"Ticket"},
     *      description="Get Ticket",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ticket",
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
     *                  ref="#/definitions/Ticket"
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
        /** @var Ticket $ticket */
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            return $this->sendError('Ticket introuvable.');
        }

        return $this->sendResponse($ticket->toArray(), 'Ticket récupéré avec succès.');
    }

    /**
     * @param int $id
     * @param UpdateTicketAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tickets/{id}",
     *      summary="Update the specified Ticket in storage",
     *      tags={"Ticket"},
     *      description="Update Ticket",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ticket",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ticket that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Ticket")
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
     *                  ref="#/definitions/Ticket"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTicketAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ticket $ticket */
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            return $this->sendError('Ticket introuvable.');
        }

        // upload the new file if exist
        if($request->hasFile('file')){
            $path = $request->file('file')->store('tickets');
            $input['file'] = Storage::url($path);
            // delete old file if exist
            $filename = basename($ticket->file);
            $exists = Storage::exists('tickets/'.$filename);
            if($exists)
            {
                // delete the old file
                Storage::delete('tickets/'.$filename);
            }
        }

        $ticket = $this->ticketRepository->update($input, $id);

        return $this->sendResponse($ticket->toArray(), 'Ticket mis à jour avec succès.');
    }

    /**
     * @param int $id
     * @param UpdateTicketAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tickets/priorite/{id}",
     *      summary="Update the priority of specified Ticket in storage",
     *      tags={"Ticket"},
     *      description="Update priorite Ticket",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ticket",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Priority string that should be updated",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="priorite",
     *                  description="priorite",
     *                  type="string"
     *              )
     *          )
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
     *                  ref="#/definitions/Ticket"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function priorite($id, UpdateTicketPrioriteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ticket $ticket */
        $ticket = $this->ticketRepository->find($id);

        $ticket = $this->ticketRepository->update($input, $id);

        return $this->sendResponse($ticket->toArray(), 'Affectation du priorité avec succès.');
    }
}
