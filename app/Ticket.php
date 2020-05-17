<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Ticket",
 *      required={"objet", "element", "nom", "date_d_ouverture", "date_d_echeance", "categorie", "impact", "etat", "lieu", "description", "photo", "priorite", "send_to_fournisseur"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="objet",
 *          description="objet",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="element",
 *          description="element",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="nom",
 *          description="nom",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date_d_ouverture",
 *          description="date_d_ouverture",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date_d_echeance",
 *          description="date_d_echeance",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="categorie",
 *          description="categorie",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="impact",
 *          description="impact",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="etat",
 *          description="etat",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="lieu",
 *          description="lieu",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="photo",
 *          description="photo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="priorite",
 *          description="priorite",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="send_to_fournisseur",
 *          description="send_to_fournisseur",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Ticket extends Model
{
    use SoftDeletes;

    public $table = 'tickets';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'objet',
        'element',
        'nom',
        'date_d_ouverture',
        'date_d_echeance',
        'categorie',
        'impact',
        'etat',
        'departement',
        'lieu',
        'num_agence',
        'commentaire',
        'description',
        'file',
        'priorite',
        'send_to_fournisseur',
        'nouvelle_anomalie',
        'ticket_status',
        'ticket_isRelanced',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'objet' => 'string',
        'element' => 'string',
        'nom' => 'string',
        'date_d_ouverture' => 'string',
        'date_d_echeance' => 'string',
        'categorie' => 'string',
        'impact' => 'string',
        'etat' => 'string',
        'lieu' => 'string',
        'description' => 'string',
        'file' => 'string',
        'send_to_fournisseur' => 'boolean',
        'nouvelle_anomalie' => 'string',
        'ticket_status' => 'boolean',
        'ticket_isRelanced' => 'boolean',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'objet' => 'required',
        'element' => 'required',
        'nom' => 'required',
        'date_d_ouverture' => 'required',
        'date_d_echeance' => 'required',
        'categorie' => 'required',
        'impact' => 'required',
        'etat' => 'required',
        'lieu' => 'required',
        'description' => 'required',
        'file' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function avis()
    {
        return $this->hasOne(\App\TicketAvis::class, 'ticket_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function reponse()
    {
        return $this->hasOne(\App\TicketResponse::class, 'ticket_id', 'id');
    }
}
