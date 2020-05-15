<?php

namespace App\Repositories;

use App\TicketResponse;
use App\Repositories\BaseRepository;

/**
 * Class TicketResponseRepository
 * @package App\Repositories
 * @version May 15, 2020, 12:07 am UTC
*/

class TicketResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom_info',
        'description_solution',
        'file',
        'ticket_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TicketResponse::class;
    }
}
