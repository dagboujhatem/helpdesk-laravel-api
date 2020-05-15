<?php

namespace App\Repositories;

use App\TicketAvis;
use App\Repositories\BaseRepository;

/**
 * Class TicketAvisRepository
 * @package App\Repositories
 * @version May 15, 2020, 12:00 am UTC
*/

class TicketAvisRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'avis',
        'description',
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
        return TicketAvis::class;
    }
}
