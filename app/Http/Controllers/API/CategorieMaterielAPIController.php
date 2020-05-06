<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategorieMaterielAPIRequest;
use App\Http\Requests\API\UpdateCategorieMaterielAPIRequest;
use App\CategorieMateriel;
use App\Repositories\CategorieMaterielRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Storage;
use Response;

/**
 * Class CategorieMaterielController
 * @package App\Http\Controllers\API
 */

class CategorieMaterielAPIController extends AppBaseController
{
    /** @var  CategorieMaterielRepository */
    private $categorieMaterielRepository;

    public function __construct(CategorieMaterielRepository $categorieMaterielRepo)
    {
        $this->categorieMaterielRepository = $categorieMaterielRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/categorieMateriels",
     *      summary="Get a listing of the CategorieMateriels.",
     *      tags={"CategorieMateriel"},
     *      description="Get all CategorieMateriels",
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
     *                  @SWG\Items(ref="#/definitions/CategorieMateriel")
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
        $categorieMateriels = $this->categorieMaterielRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($categorieMateriels->toArray(),
            'Catégories matériels récupérées avec succès.');
    }

    /**
     * @param CreateCategorieMaterielAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/categorieMateriels",
     *      summary="Store a newly created CategorieMateriel in storage",
     *      tags={"CategorieMateriel"},
     *      description="Store CategorieMateriel",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CategorieMateriel that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CategorieMateriel")
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
     *                  ref="#/definitions/CategorieMateriel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCategorieMaterielAPIRequest $request)
    {
        $input = $request->all();

        // save the file-solution
        if($request->hasFile('solution_file')){
            $path = $request->file('solution_file')->store('solution_categorie_materiel');
            $input['solution_file'] = Storage::url($path);
        }

        $categorieMateriel = $this->categorieMaterielRepository->create($input);

        return $this->sendResponse($categorieMateriel->toArray(),
            'Catégorie matériel enregistré avec succès.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/categorieMateriels/{id}",
     *      summary="Display the specified CategorieMateriel",
     *      tags={"CategorieMateriel"},
     *      description="Get CategorieMateriel",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CategorieMateriel",
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
     *                  ref="#/definitions/CategorieMateriel"
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
        /** @var CategorieMateriel $categorieMateriel */
        $categorieMateriel = $this->categorieMaterielRepository->find($id);

        if (empty($categorieMateriel)) {
            return $this->sendError('Catégorie matériel introuvable.');
        }

        return $this->sendResponse($categorieMateriel->toArray(),
            'Catégorie matériel récupéré avec succès.');
    }

    /**
     * @param int $id
     * @param UpdateCategorieMaterielAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/categorieMateriels/{id}",
     *      summary="Update the specified CategorieMateriel in storage",
     *      tags={"CategorieMateriel"},
     *      description="Update CategorieMateriel",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CategorieMateriel",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CategorieMateriel that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CategorieMateriel")
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
     *                  ref="#/definitions/CategorieMateriel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCategorieMaterielAPIRequest $request)
    {
        $input = $request->all();

        /** @var CategorieMateriel $categorieMateriel */
        $categorieMateriel = $this->categorieMaterielRepository->find($id);

        if (empty($categorieMateriel)) {
            return $this->sendError('Catégorie matériel introuvable.');
        }

        $categorieMateriel = $this->categorieMaterielRepository->update($input, $id);

        return $this->sendResponse($categorieMateriel->toArray(),
            'Catégorie matériel mis à jour avec succès.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/categorieMateriels/{id}",
     *      summary="Remove the specified CategorieMateriel from storage",
     *      tags={"CategorieMateriel"},
     *      description="Delete CategorieMateriel",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CategorieMateriel",
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
        /** @var CategorieMateriel $categorieMateriel */
        $categorieMateriel = $this->categorieMaterielRepository->find($id);

        if (empty($categorieMateriel)) {
            return $this->sendError('Catégorie matériel introuvable.');
        }

        // delete solution_file if exist
        $filename = basename($categorieMateriel->solution_file);
        $exists = Storage::exists('solution_categorie_materiel/'.$filename);
        if($exists)
        {
            // delete the solution_file
            Storage::delete('solution_categorie_materiel/'.$filename);
        }

        // delete catégorie matériel fom DB
        $categorieMateriel->delete();

        return $this->sendSuccess('Catégorie matériel supprimée avec succès.');
    }
}
