<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function validarUsers($data){        
        
        $validarUser = User::orderBy('id', 'asc')        
        ->where('email', $data['user'])
        ->where('password', md5($data['password']))
        ->get();

        $data = [
            "email" => $validarUser[0]['email'],
            "id" => $validarUser[0]['id'],
            "name" => $validarUser[0]['name']
        ];
        
            
        return (count($validarUser) > 0) ? ['validate' => true, 'userData' => $data ] : ['validate' => false, 'userData' => null];
    }

    public function obtainUsersByParentId(){        
        
        $Users = User::orderBy('id', 'asc')        
        ->where('is_parent', 0)
        ->get();
        
            
        return $Users;
    }

}
