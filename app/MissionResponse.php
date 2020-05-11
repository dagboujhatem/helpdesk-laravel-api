<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="MissionResponse",
 *      required={"nom", "collaborateurs", "mission", "date_debut", "date_fin", "reponse", "isConfirmed", "mission_id"},
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
 *          property="collaborateurs",
 *          description="collaborateurs",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="mission",
 *          description="mission",
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
 *          property="reponse",
 *          description="reponse",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="isConfirmed",
 *          description="isConfirmed",
 *          type="boolean",
 *          default=false
 *      ),
 *      @SWG\Property(
 *          property="mission_id",
 *          description="mission_id",
 *          type="integer",
 *          format="int32"
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
class MissionResponse extends Model
{
    use SoftDeletes;

    public $table = 'mission_responses';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'collaborateurs',
        'mission',
        'date_debut',
        'date_fin',
        'reponse',
        'isConfirmed',
        'mission_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'collaborateurs' => 'string',
        'mission' => 'string',
        'date_debut' => 'string',
        'date_fin' => 'string',
        'reponse' => 'string',
        'mission_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required',
        'collaborateurs' => 'required',
        'mission' => 'required',
        'date_debut' => 'required',
        'date_fin' => 'required',
        'reponse' => 'required',
        'mission_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function mission()
    {
        return $this->belongsTo(\App\Mission::class, 'mission_id');
    }
}
