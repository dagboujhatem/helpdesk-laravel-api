<?php

namespace App\Repositories;

use App\CategorieApplicatif;
use App\Repositories\BaseRepository;

/**
 * Class CategorieApplicatifRepository
 * @package App\Repositories
 * @version May 5, 2020, 5:41 pm UTC
*/

class CategorieApplicatifRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
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
        return CategorieApplicatif::class;
    }
}
