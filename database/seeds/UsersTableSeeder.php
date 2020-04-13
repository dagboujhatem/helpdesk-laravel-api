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
                'identifiant' => $faker->uuid ,
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName ,
                'email' => 'admin@gmail.com' ,
                'password' => bcrypt('password'),
                'cin' => '12345678',
                'telephone' => $faker->e164PhoneNumber ,
                'adresse' => $faker->streetAddress,
                'departement' => 'Monétique',
                'lieu_de_travail' => 'Siége',
                'date_d_embauche' => now(),
                'photo' => $faker->unique()->imageUrl($width = 50, $height = 50 ,'people'),
                'role' => '0' ,
                ])->assignRole('Administrateur');


                // insert a default Informaticien
                User::create([
                'identifiant' => $faker->uuid ,
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName ,
                'email' => 'informaticien@gmail.com' ,
                'password' => bcrypt('password'),
                'cin' => '12345678',
                'telephone' => $faker->e164PhoneNumber ,
                'adresse' => $faker->streetAddress,
                'departement' => 'Monétique',
                'lieu_de_travail' => 'Siége',
                'date_d_embauche' => now(),
                'photo' => $faker->unique()->imageUrl($width = 50, $height = 50 ,'people'),
                'role' => '0' ,
                ])->assignRole('Informaticien');

                // insert a default Personnel
                User::create([
                'identifiant' => $faker->uuid ,
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName ,
                'email' => 'personnel@gmail.com' ,
                'password' => bcrypt('password'),
                'cin' => '12345678',
                'telephone' => $faker->e164PhoneNumber ,
                'adresse' => $faker->streetAddress,
                'departement' => 'Monétique',
                'lieu_de_travail' => 'Siége',
                'date_d_embauche' => now(),
                'photo' => $faker->unique()->imageUrl($width = 50, $height = 50 ,'people'),
                'role' => '0' ,
                ])->assignRole('Personnel');

                // insert a default Fournisseur
                User::create([
                'identifiant' => $faker->uuid ,
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName ,
                'email' => 'fournisseur@gmail.com' ,
                'password' => bcrypt('password'),
                'cin' => '12345678',
                'telephone' => $faker->e164PhoneNumber ,
                'adresse' => $faker->streetAddress,
                'departement' => 'Monétique',
                'lieu_de_travail' => 'Siége',
                'date_d_embauche' => now(),
                'photo' => $faker->unique()->imageUrl($width = 50, $height = 50 ,'people'),
                'role' => '0' ,
                ])->assignRole('Fournisseur');

            }else
            {
                echo "Table USERS is not empty! \n";
            }
    }
}
