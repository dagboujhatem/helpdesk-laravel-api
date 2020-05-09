<?php

namespace App\Repositories;

use App\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version April 13, 2020, 2:07 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'identifiant',
        'nom',
        'prenom',
        'email',
        'password',
        'cin',
        'telephone',
        'adresse',
        'departement',
        'lieu_de_travail',
        'date_d_embauche',
        'photo'
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
        return User::class;
    }

    // get user by email address
    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
