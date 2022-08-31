<?php

namespace App\Policies;

use App\Models\Disciplina;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Facades\UserPermission;

class DisciplinaPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return UserPermission::isAuthorized('disciplinas.index');
    }

   
    public function view(User $user, Disciplina $disciplina)
    {
        return UserPermission::isAuthorized('disciplinas.show');
    }

  
    public function create(User $user)
    {
        return UserPermission::isAuthorized('disciplinas.create');
    }

  
    public function update(User $user, Disciplina $disciplina)
    {
        return UserPermission::isAuthorized('disciplinas.edit');
    }

  
    public function delete(User $user, Disciplina $disciplina)
    {
        return UserPermission::isAuthorized('disciplinas.destroy');
    }

    
    public function restore(User $user, Disciplina $disciplina)
    {
        //
    }

  
    public function forceDelete(User $user, Disciplina $disciplina)
    {
        //
    }
}
