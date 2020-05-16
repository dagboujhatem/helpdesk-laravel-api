<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="TicketResponse",
 *      required={"nom_info", "description_solution", "file", "ticket_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nom_info",
 *          description="nom_info",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description_solution",
 *          description="description_solution",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="file",
 *          description="file",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ticket_id",
 *          description="ticket_id",
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
class TicketResponse extends Model
{
    use SoftDeletes;

    public $table = 'ticket_responses';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom_info',
        'description_solution',
        'file',
        'ticket_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom_info' => 'string',
        'description_solution' => 'string',
        'file' => 'string',
        'ticket_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom_info' => 'required',
        'description_solution' => 'required',
        'file' => 'required',
        'ticket_id' => 'required'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function ticket()
    {
        return $this->belongsTo(\App\Ticket::class, 'ticket_id');
    }
}
