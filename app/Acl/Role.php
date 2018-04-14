<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     public function permissions()
    {
        return $this->belongsToMany(\App\Models\Acl\Permission::class);
    }
}
