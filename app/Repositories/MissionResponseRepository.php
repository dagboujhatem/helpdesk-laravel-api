<?php

namespace App\Repositories;

use App\MissionResponse;
use App\Repositories\BaseRepository;

/**
 * Class MissionResponseRepository
 * @package App\Repositories
 * @version May 9, 2020, 3:17 pm UTC
*/

class MissionResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'collaborateurs',
        'mission',
        'date_debut',
        'date_fin',
        'reponse',
        'mission_id'
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
        return MissionResponse::class;
    }
}
