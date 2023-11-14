<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThemeMiddleware
{
    public function handle($request, Closure $next)
    {
        // Получаем текущую тему пользователя из объекта запроса
        $theme = $this->getThemeFromRequest($request);

        // Устанавливаем тему приложения
        config(['app.theme' => $theme]);

        return $next($request);
    }

    // Получаем тему пользователя из объекта запроса
    private function getThemeFromRequest($request)
    {
        // Возвращаем тему из запроса, если она установлена, иначе возвращаем тему 'light' по умолчанию
        return $request->input('theme', 'light');
    }
//    /**
//     * Handle an incoming request.
//     *
//     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//     */
//    public function handle(Request $request, Closure $next): Response
//    {
//        return $next($request);
//    }
}
