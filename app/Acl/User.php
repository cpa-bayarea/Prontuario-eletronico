<?php

namespace App\Models\Acl;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Acl\Pernmission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tipo_user_id','situacao_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function roles(){
        return $this->belongsToMany(\App\Models\Acl\Role::class);
    }
    
    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }
    public function hasAnyRoles($roles)
    {
        if(is_array($roles)||is_object($roles)){
           return !!  $roles->intersect($this->roles)->count();
        }
        
        //verifica se o usuario tem o perfil vinculado com a permissão
        return $this->roles->contains('name',$roles);
    }
}
