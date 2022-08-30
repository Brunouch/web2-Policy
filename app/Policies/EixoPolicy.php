<?php

namespace App\Policies;

use App\Models\Eixo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EixoPolicy
{
    use HandlesAuthorization;

  
    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('eixos.index');
    }

   
    public function view(User $user, Eixo $eixo)
    {
        return UserPermissions::isAuthorized('eixos.show');
    }

  
    public function create(User $user)
    {
        return UserPermissions::isAuthorized('eixos.create');
    }

 
    public function update(User $user, Eixo $eixo)
    {
        return UserPermissions::isAuthorized('eixos.edit');
    }

 
    public function delete(User $user, Eixo $eixo)
    {
        return UserPermissions::isAuthorized('eixos.destroy');
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
