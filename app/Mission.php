<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Mission",
 *      required={"nom", "fonction", "date_debut", "date_fin", "mission", "description"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nom",
 *          description="nom",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="fonction",
 *          description="fonction",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date_debut",
 *          description="date_debut",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date_fin",
 *          description="date_fin",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="mission",
 *          description="mission",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
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
class Mission extends Model
{
    use SoftDeletes;

    public $table = 'missions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'fonction',
        'date_debut',
        'date_fin',
        'mission',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'fonction' => 'string',
        'date_debut' => 'string',
        'date_fin' => 'string',
        'mission' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required',
        'fonction' => 'required',
        'date_debut' => 'required',
        'date_fin' => 'required',
        'mission' => 'required',
        'description' => 'required'
    ];

    
}
