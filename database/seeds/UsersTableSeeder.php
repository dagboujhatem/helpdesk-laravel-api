<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
            //test if table is empty
            if(DB::table('users')->get()->count()<=1)
            {
                // insert users

                // insert a default Administrateur
                User::create([
                'identifiant' => $faker->randomNumber($nbDigits = 8, $strict = false) ,
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName ,
                'email' => 'admin@gmail.com' ,
                'password' => bcrypt('password'),
                'cin' => $faker->randomNumber($nbDigits = 8, $strict = false) ,
                'telephone' => $faker->e164PhoneNumber ,
                'adresse' => $faker->streetAddress,
                'departement' => 'Monétique',
                'lieu_de_travail' => 'Siège',
                'date_d_embauche' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'photo' => 'assets/img/avatars/6.jpg',
                ])->assignRole('Administrateur');


                // insert a default Informaticien
                User::create([
                'identifiant' => $faker->randomNumber($nbDigits = 8, $strict = false) ,
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName ,
                'email' => 'informaticien@gmail.com' ,
                'password' => bcrypt('password'),
                'cin' => $faker->randomNumber($nbDigits = 8, $strict = false) ,
                'telephone' => $faker->e164PhoneNumber ,
                'adresse' => $faker->streetAddress,
                'departement' => 'Monétique',
                'lieu_de_travail' => 'Agence',
                'date_d_embauche' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'photo' => 'assets/img/avatars/8.jpg',
                ])->assignRole('Informaticien');

                // insert a default Personnel
                User::create([
                'identifiant' => $faker->randomNumber($nbDigits = 8, $strict = false) ,
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName ,
                'email' => 'personnel@gmail.com' ,
                'password' => bcrypt('password'),
                'cin' => $faker->randomNumber($nbDigits = 8, $strict = false) ,
                'telephone' => $faker->e164PhoneNumber ,
                'adresse' => $faker->streetAddress,
                'departement' => 'Monétique',
                'lieu_de_travail' => 'Siège',
                'date_d_embauche' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'photo' => 'assets/img/avatars/3.jpg',
                ])->assignRole('Personnel');

                // insert a default Fournisseur
                User::create([
                'identifiant' => $faker->randomNumber($nbDigits = 8, $strict = false) ,
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName ,
                'email' => 'fournisseur@gmail.com' ,
                'password' => bcrypt('password'),
                'cin' => $faker->randomNumber($nbDigits = 8, $strict = false) ,
                'telephone' => $faker->e164PhoneNumber ,
                'adresse' => $faker->streetAddress,
                'departement' => 'Monétique',
                'lieu_de_travail' => 'Agence',
                'date_d_embauche' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'photo' => 'assets/img/avatars/2.jpg',
                ])->assignRole('Fournisseur');

            }else
            {
                echo "Table USERS is not empty! \n";
            }
    }
}
