<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        // return Auth::logout();
        
        $lastLoginTime = Carbon::parse($user->created_at);
        $totalMessagesSent =$user->messages()->count();
        $lastFiveMessages = $user->messages()->latest()->take(5)->get(); 
        // dd(23432,  $totalMessagesSent);
        return view('home')->with([
            'lastLoginTime' => $lastLoginTime, 
            'totalMessagesSent'=>  $totalMessagesSent,
            'lastFiveMessages'=>   $lastFiveMessages]);
    }
};
