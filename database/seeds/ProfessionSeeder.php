<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//DB::insert('INSERT INTO professions (title) VALUES("Desarrollador front-end")');  This is not secure from injections attack.

    	// DB::insert('INSERT INTO professions (title) VALUES(?)',['Desarrollador front-en d']); 

    	// DB::insert('INSERT INTO professions (title) VALUES(:title)',[
    	// 	'title'=>'Desarrollador front-end',
    	// ]); 

    	// Here is the laravel style using query builder


    	// DB::table('professions')->insert([
     //    	'title' =>'Back-end developer',
     //     ]);

    	// DB::table('professions')->insert([
        // 	'title' =>'Desarrollador back-end',
        // ]);	

         //here is the Eloquent style	

   		Profession::create([
        	'title' =>'Front-end developer',
         ]);	

        Profession::create([
        	'title' =>'Back-end developer',
         ]);	

        Profession::create([
        	'title' =>'Desarrollador back-end',
         ]);

        factory(Profession::class,17)->create();

        
       
    }
}
