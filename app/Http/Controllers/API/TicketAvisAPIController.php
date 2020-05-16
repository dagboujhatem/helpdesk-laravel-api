<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTicketAvisAPIRequest;
use App\Http\Requests\API\UpdateTicketAvisAPIRequest;
use App\TicketAvis;
use App\Repositories\TicketAvisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TicketAvisController
 * @package App\Http\Controllers\API
 */

class TicketAvisAPIController extends AppBaseController
{
    /** @var  TicketAvisRepository */
    private $ticketAvisRepository;

    public function __construct(TicketAvisRepository $ticketAvisRepo)
    {
        $this->ticketAvisRepository = $ticketAvisRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/ticketAvis",
     *      summary="Get a listing of the TicketAvis.",
     *      tags={"TicketAvis"},
     *      description="Get all TicketAvis",
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
     *                  @SWG\Items(ref="#/definitions/TicketAvis")
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
        $ticketAvis = $this->ticketAvisRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        // pour chacune des avis
        foreach ($ticketAvis as $avis) {
            // recuperer le ticket de cette avis
            $avis = $avis->ticket;
        }

        return $this->sendResponse($ticketAvis->toArray(),
            'Avis récupérés avec succès.');
    }

    /**
     * @param CreateTicketAvisAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/ticketAvis",
     *      summary="Store a newly created TicketAvis in storage",
     *      tags={"TicketAvis"},
     *      description="Store TicketAvis",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TicketAvis that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TicketAvis")
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
     *                  ref="#/definitions/TicketAvis"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTicketAvisAPIRequest $request)
    {
        $input = $request->all();

        $ticketAvis = $this->ticketAvisRepository->create($input);

        return $this->sendResponse($ticketAvis->toArray(),
            'Avis a été ajouté avec succès.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/ticketAvis/{id}",
     *      summary="Display the specified TicketAvis",
     *      tags={"TicketAvis"},
     *      description="Get TicketAvis",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TicketAvis",
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
     *                  ref="#/definitions/TicketAvis"
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
        /** @var TicketAvis $ticketAvis */
        $ticketAvis = $this->ticketAvisRepository->find($id);

        if (empty($ticketAvis)) {
            return $this->sendError('Avis non trouvé.');
        }
        // récupérer le ticket de cette avis
        $ticketAvis->ticket;

        return $this->sendResponse($ticketAvis->toArray(),
            'Avis récupéré avec succès.');
    }
}
