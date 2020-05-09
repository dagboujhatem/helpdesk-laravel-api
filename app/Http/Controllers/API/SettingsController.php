<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends AppBaseController
{

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }


    // get user info by email
    public function getUserInfoByEmailAddress($email)
    {
        /** @var User $user */
        $user = $this->userRepository->getUserByEmail($email);

        if (empty($user)) {
            return $this->sendError('Utilisateur non trouvé.');
        }

        // get the user role
        $user['role'] = $user->getRoleNames()->first();

        return $this->sendResponse($user->toArray(), 'L\'utilisateur a été récupéré avec succès.');
    }

    // save setting
    public function saveSettings($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('Utilisateur non trouvé.');
        }

        // crypt the password if exist
        if ($request->password){
            $input['password'] = Hash::make($input['password']);
        }

        // upload the new photo if exist
        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('avatars');
            $input['photo'] = Storage::url($path);
            // delete old photo if exist
            $filename = basename($user->photo);
            $exists = Storage::exists('avatars/'.$filename);
            if($exists)
            {
                // delete the photo
                Storage::delete('avatars/'.$filename);
            }
        }

        $user = $this->userRepository->update($input, $id);

        // re-assign role if is changed in angular interface
        if($request->role !== $user->getRoleNames()->first())
        {
            // delete old role
            $user->removeRole($user->roles->first());
            // assign new role
            $role = $input['role'];
            $user->assignRole($role);
        }

        return $this->sendResponse($user->toArray(), 'Votre profil a été mis à jour avec succès.');

    }
}
