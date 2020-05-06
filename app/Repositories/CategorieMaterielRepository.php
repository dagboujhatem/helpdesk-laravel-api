<?php

namespace App\Repositories;

use App\CategorieMateriel;
use App\Repositories\BaseRepository;

/**
 * Class CategorieMaterielRepository
 * @package App\Repositories
 * @version May 5, 2020, 5:35 pm UTC
*/

class CategorieMaterielRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'objet',
        'probleme',
        'description',
        'solution_file'
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
        return CategorieMateriel::class;
    }
}
