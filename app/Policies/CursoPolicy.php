<?php

namespace App\Policies;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Facades\UserPermissions;
use Illuminate\Auth\Access\Gate;

class CursoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('cursos.index');
    }

  
    public function view(User $user, Curso $curso)
    {
        return UserPermissions::isAuthorized('cursos.show');
    }

   
    public function create(User $user)
    {
        return UserPermissions::isAuthorized('cursos.create');
    }

    
    public function update(User $user, Curso $curso)
    {
        return UserPermissions::isAuthorized('cursos.edit');
    }

  
    public function delete(User $user, Curso $curso)
    {
        return UserPermissions::isAuthorized('cursos.destroy');
    }

  
    public function restore(User $user, Curso $curso)
    {
        //
    }

    
    public function forceDelete(User $user, Curso $curso)
    {
        //
    }
}
