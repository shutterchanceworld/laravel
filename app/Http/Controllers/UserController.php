<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        //dd($users);

        $title =  'List of Users';

        return view('users.index', compact('title','users'));
            
    }

    public function show(User $user)
    {
    	//$user = User::findOrFail($id);
        //dd($user);

        return view('users.show',compact('user'));
    }

    public function create()
    {
    	
    	return view('users.create');
    }

    public function store()
    {

        //$data = request()->all(); 

        $data = request()->validate([
            'name' => 'required',
            'email' => ['required','email','unique:users,email'],
            'password' => 'required',
        ],[
            'name.required' => 'The name field is required'
        ]); 

        // if(empty($data['name'])) {
        //     return redirect('users/new')->withErrors([
        //         'name' => 'The name field is requiered'
        //     ]);
        // } 


        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect('users');
    }

    public function edit(User $user)
    {
        return view('users.edit',['user'=>$user]);
    }   


    public function update(User $user)
    {
        $data = request()->validate([
            'name'  => 'required',
            'email' => '',
            'password' => '',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user->update($data);
        return redirect()->route('users.show',['user' => $user]);
        
    }    

}
