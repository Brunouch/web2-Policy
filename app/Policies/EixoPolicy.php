<?php

namespace App\Policies;

use App\Models\Eixo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Facades\UserPermission;

class EixoPolicy
{
    use HandlesAuthorization;

  
    public function viewAny(User $user)
    {
        return UserPermission::isAuthorized('eixos.index');
    }

   
    public function view(User $user, Eixo $eixo)
    {
        return UserPermission::isAuthorized('eixos.show');
    }

  
    public function create(User $user)
    {
        return UserPermission::isAuthorized('eixos.create');
    }

 
    public function update(User $user, Eixo $eixo)
    {
        return UserPermission::isAuthorized('eixos.edit');
    }

 
    public function delete(User $user, Eixo $eixo)
    {
        return UserPermission::isAuthorized('eixos.destroy');
    }

   
    public function restore(User $user, Eixo $eixo)
    {
        //
    }

    public function forceDelete(User $user, Eixo $eixo)
    {
        //
    }
}
