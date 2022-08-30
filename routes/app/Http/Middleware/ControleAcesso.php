<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class ControleAcesso
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next, $nivelAcesso)
    {

        $route = Route::currentRouteName();

        if ($nivelAcesso == 1) {
            if ((strcmp($route, "cursos.index") != 0 && strcmp($route, "eixos.index") != 0)) {
                return response()->view('templates.restrito');
            }
        } elseif ($nivelAcesso == 2) {
            $arr = explode('.', $route);
            if (strcmp($arr[0], "professores") == 0 || strcmp($arr[0], "alunos") == 0 || strcmp($arr[0], "disciplinas") == 0) {
                if (strcmp($route, "professores.index") != 0 && strcmp($route, "alunos.index") != 0 && strcmp($route, "disciplinas.index") != 0) {
                    return response()->view('templates.restrito');
                }
            }
        }

        return $next($request);;
    }
}
