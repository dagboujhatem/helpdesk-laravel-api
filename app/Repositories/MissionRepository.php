<?php

namespace App\Repositories;

use App\Mission;
use App\Repositories\BaseRepository;

/**
 * Class MissionRepository
 * @package App\Repositories
 * @version May 6, 2020, 9:57 pm UTC
*/

class MissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'fonction',
        'date_debut',
        'date_fin',
        'mission',
        'description'
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
        return Mission::class;
    }
}
