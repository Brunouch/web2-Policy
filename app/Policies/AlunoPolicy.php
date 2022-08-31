<?php

namespace App\Policies;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Facades\UserPermission;

class AlunoPolicy
{
    use HandlesAuthorization;

  
    public function viewAny(User $user)
    {
        return UserPermission::isAuthorized('alunos.index');
    }

 
    public function view(User $user, Aluno $aluno)
    {
        return UserPermission::isAuthorized('alunos.show');
    }

   
    public function create(User $user)
    {
        return UserPermission::isAuthorized('alunos.create');
    }

   
    public function update(User $user, Aluno $aluno)
    {
        return UserPermission::isAuthorized('alunos.edit');
    }

   
    public function delete(User $user, Aluno $aluno)
    {
        return UserPermission::isAuthorized('alunos.destroy');
    }

 
    public function restore(User $user, Aluno $aluno)
    {
        
    }

    public function forceDelete(User $user, Aluno $aluno)
    {
        //
    }
}
