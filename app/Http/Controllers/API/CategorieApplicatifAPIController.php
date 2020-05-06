<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategorieApplicatifAPIRequest;
use App\Http\Requests\API\UpdateCategorieApplicatifAPIRequest;
use App\CategorieApplicatif;
use App\Repositories\CategorieApplicatifRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Storage;
use Response;

/**
 * Class CategorieApplicatifController
 * @package App\Http\Controllers\API
 */

class CategorieApplicatifAPIController extends AppBaseController
{
    /** @var  CategorieApplicatifRepository */
    private $categorieApplicatifRepository;

    public function __construct(CategorieApplicatifRepository $categorieApplicatifRepo)
    {
        $this->categorieApplicatifRepository = $categorieApplicatifRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/categorieApplicatifs",
     *      summary="Get a listing of the CategorieApplicatifs.",
     *      tags={"CategorieApplicatif"},
     *      description="Get all CategorieApplicatifs",
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
     *                  @SWG\Items(ref="#/definitions/CategorieApplicatif")
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
        $categorieApplicatifs = $this->categorieApplicatifRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($categorieApplicatifs->toArray(),
            'Catégories applicatifs récupérées avec succès.');
    }

    /**
     * @param CreateCategorieApplicatifAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/categorieApplicatifs",
     *      summary="Store a newly created CategorieApplicatif in storage",
     *      tags={"CategorieApplicatif"},
     *      description="Store CategorieApplicatif",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CategorieApplicatif that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CategorieApplicatif")
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
     *                  ref="#/definitions/CategorieApplicatif"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCategorieApplicatifAPIRequest $request)
    {
        $input = $request->all();

        // save the file-solution
        if($request->hasFile('solution_file')){
            $path = $request->file('solution_file')->store('solution_categorie_applicatif');
            $input['solution_file'] = Storage::url($path);
        }

        $categorieApplicatif = $this->categorieApplicatifRepository->create($input);

        return $this->sendResponse($categorieApplicatif->toArray(),
            'Catégorie applicatif enregistrée avec succès.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/categorieApplicatifs/{id}",
     *      summary="Display the specified CategorieApplicatif",
     *      tags={"CategorieApplicatif"},
     *      description="Get CategorieApplicatif",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CategorieApplicatif",
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
     *                  ref="#/definitions/CategorieApplicatif"
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
        /** @var CategorieApplicatif $categorieApplicatif */
        $categorieApplicatif = $this->categorieApplicatifRepository->find($id);

        if (empty($categorieApplicatif)) {
            return $this->sendError('Catégorie applicatif introuvable.');
        }

        return $this->sendResponse($categorieApplicatif->toArray(),
            'Catégorie applicatif récupérée avec succès.');
    }

    /**
     * @param int $id
     * @param UpdateCategorieApplicatifAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/categorieApplicatifs/{id}",
     *      summary="Update the specified CategorieApplicatif in storage",
     *      tags={"CategorieApplicatif"},
     *      description="Update CategorieApplicatif",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CategorieApplicatif",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CategorieApplicatif that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CategorieApplicatif")
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
     *                  ref="#/definitions/CategorieApplicatif"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCategorieApplicatifAPIRequest $request)
    {
        $input = $request->all();

        /** @var CategorieApplicatif $categorieApplicatif */
        $categorieApplicatif = $this->categorieApplicatifRepository->find($id);

        if (empty($categorieApplicatif)) {
            return $this->sendError('Catégorie applicatif introuvable.');
        }

        // if request has file-solution
        if($request->hasFile('solution_file')){
            // 1.0 upload new solution_file
            $path = $request->file('solution_file')->store('solution_categorie_applicatif');
            $input['solution_file'] = Storage::url($path);
            // 2.0 delete old solution_file
            // delete solution_file if exist
            $filename = basename($categorieApplicatif->solution_file);
            $exists = Storage::exists('solution_categorie_applicatif/'.$filename);
            if($exists)
            {
                // delete the solution_file
                Storage::delete('solution_categorie_applicatif/'.$filename);
            }
        }

        $categorieApplicatif = $this->categorieApplicatifRepository->update($input, $id);

        return $this->sendResponse($categorieApplicatif->toArray(),
            'Catégorie applicatif mis à jour avec succès');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/categorieApplicatifs/{id}",
     *      summary="Remove the specified CategorieApplicatif from storage",
     *      tags={"CategorieApplicatif"},
     *      description="Delete CategorieApplicatif",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CategorieApplicatif",
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
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var CategorieApplicatif $categorieApplicatif */
        $categorieApplicatif = $this->categorieApplicatifRepository->find($id);

        if (empty($categorieApplicatif)) {
            return $this->sendError('Catégorie applicatif introuvable.');
        }

        // delete solution_file if exist
        $filename = basename($categorieApplicatif->solution_file);
        $exists = Storage::exists('solution_categorie_applicatif/'.$filename);
        if($exists)
        {
            // delete the solution_file
            Storage::delete('solution_categorie_applicatif/'.$filename);
        }

        // delete catégorie applicatif fom DB
        $categorieApplicatif->delete();

        return $this->sendSuccess('Catégorie applicatif supprimée avec succès.');
    }
}
