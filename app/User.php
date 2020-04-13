<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={"identifiant", "nom", "prenom", "email", "password", "cin", "telephone", "adresse", "departement", "lieu_de_travail", "date_d_embauche", "photo", "role"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="identifiant",
 *          description="identifiant",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="nom",
 *          description="nom",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="prenom",
 *          description="prenom",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cin",
 *          description="cin",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="telephone",
 *          description="telephone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="adresse",
 *          description="adresse",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="departement",
 *          description="departement",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="lieu_de_travail",
 *          description="lieu_de_travail",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date_d_embauche",
 *          description="date_d_embauche",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="photo",
 *          description="photo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="role",
 *          description="role",
 *          type="string"
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
class User extends Authenticatable
{
    use SoftDeletes, HasRoles;

    public $table = 'users';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'identifiant',
        'nom',
        'prenom',
        'email',
        'password',
        'cin',
        'telephone',
        'adresse',
        'departement',
        'lieu_de_travail',
        'date_d_embauche',
        'photo',
        'role'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'identifiant' => 'string',
        'nom' => 'string',
        'prenom' => 'string',
        'email' => 'string',
        'password' => 'string',
        'cin' => 'string',
        'telephone' => 'string',
        'adresse' => 'string',
        'departement' => 'string',
        'lieu_de_travail' => 'string',
        'date_d_embauche' => 'date',
        'photo' => 'string',
        'role' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'identifiant' => 'required',
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required',
        'password' => 'required',
        'cin' => 'required',
        'telephone' => 'required',
        'adresse' => 'required',
        'departement' => 'required',
        'lieu_de_travail' => 'required',
        'date_d_embauche' => 'required',
        'photo' => 'required',
        'role' => 'required'
    ];


}
