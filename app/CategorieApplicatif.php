<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="CategorieApplicatif",
 *      required={"type", "probleme", "description", "solution_file"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="probleme",
 *          description="probleme",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="solution_file",
 *          description="solution_file",
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
class CategorieApplicatif extends Model
{
    use SoftDeletes;

    public $table = 'categorie_applicatifs';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'probleme',
        'description',
        'solution_file'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'probleme' => 'string',
        'description' => 'string',
        'solution_file' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required|string',
        'probleme' => 'required|string',
        'description' => 'required|string',
        'solution_file' => 'required'
    ];


}
