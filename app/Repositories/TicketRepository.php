<?php

namespace App\Repositories;

use App\Ticket;
use App\Repositories\BaseRepository;

/**
 * Class TicketRepository
 * @package App\Repositories
 * @version April 24, 2020, 9:47 pm UTC
*/

class TicketRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        'description',
        'photo',
        'priorite'
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
        return Ticket::class;
    }
}
