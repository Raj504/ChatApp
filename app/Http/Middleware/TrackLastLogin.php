<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
class TrackLastLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_login_at = now();
            $user =  User::find($user->id);
            $user->update(['last_login_at' => now()]);
            //$user->last_login_at = now();
             $user->save();
    }
    return $next($request);

}}

