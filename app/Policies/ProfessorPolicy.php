<?php

namespace App\Policies;

use App\Models\Professor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessorPolicy
{
    use HandlesAuthorization;

   
    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('professores.index');
    }

  
    public function view(User $user, Professor $professor)
    {
        return UserPermissions::isAuthorized('professores.show');
    }

  
    public function create(User $user)
    {
        return UserPermissions::isAuthorized('professores.create');
    }

   
    public function update(User $user, Professor $professor)
    {
        return UserPermissions::isAuthorized('professores.edit');
    }

    
    public function delete(User $user, Professor $professor)
    {
        return UserPermissions::isAuthorized('professores.destroy');
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
