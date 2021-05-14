<?php

namespace App\Repositories;

use App\test;
use App\Repositories\BaseRepository;

/**
 * Class testRepository
 * @package App\Repositories
 * @version April 25, 2021, 4:25 am UTC
*/

class testRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return test::class;
    }
}
