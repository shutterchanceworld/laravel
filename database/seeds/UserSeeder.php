<?php
use App\User;
use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// Here expose for sql injection
    	// $professions = DB::select('SELECT id FROM professions WHERE title = "Desarrollador front-end"');

    	//correcting the form to avoid sql injection
    	// Here is the SQL style
    	// $professions = DB::select('SELECT id FROM professions WHERE title = ? LIMIT 0,1', ['Desarrollador back-end']);

    	//Here have the Laravel style:
    	// $profession = DB::table('professions')->select('id')->first();

    	//adding where to matching
    	// $profession = DB::table('professions')->select('id')->where('title','=','Desarrollador back-end')->first();

    	//better form

    	// $professionId = DB::table('professions')
    	// ->where('title','Desarrollador back-end')
    	// ->value('id');

    	// $professionId = DB::table('professions')
    	// ->whereTitle('Desarrollador back-end')
    	// ->value('id');

    	// using ORM eloquent
    	$professionId = Profession::where('title','Desarrollador back-end')->value('id');

    	
    	//dd($profession[0]->id); //object form 
    	//Only for check before insert data
    		
    	//dd($profession);//Array form 
    	//dd($profession->first()->id);//Object form 2


        // DB::table('users')->insert([
        // 	'name' => 'Hiroaki Takeshima',
        // 	'email' => 'aaa@aaa.com',
        // 	'password' => bcrypt('laravel'),
        // 	'profession_id'=>$professionId,
        // ]);

        //using ORM eloquent
        factory(User::class)->create([
        	'name' => 'Hiroaki Takeshima',
        	'email' => 'aaa@aaa.com',
        	'password' => bcrypt('laravel'),
        	'profession_id'=>$professionId,
        ]);

        factory(User::class,48)->create();

       


        factory(User::class)->create([
            'profession_id'=>$professionId
        ]);


    }
}
