<?php

namespace App\Policies;

use App\Models\Professor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Facades\UserPermission;

class ProfessorPolicy
{
    use HandlesAuthorization;

   
    public function viewAny(User $user)
    {
        return UserPermission::isAuthorized('professores.index');
    }

  
    public function view(User $user, Professor $professor)
    {
        return UserPermission::isAuthorized('professores.show');
    }

  
    public function create(User $user)
    {
        return UserPermission::isAuthorized('professores.create');
    }

   
    public function update(User $user, Professor $professor)
    {
        return UserPermission::isAuthorized('professores.edit');
    }

    
    public function delete(User $user, Professor $professor)
    {
        return UserPermission::isAuthorized('professores.destroy');
    }

    
    public function restore(User $user, Professor $professor)
    {
        //
    }

   
    public function forceDelete(User $user, Professor $professor)
    {
        //
    }
}
