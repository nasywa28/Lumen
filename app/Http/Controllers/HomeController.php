<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\SessionGuard;


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
        $user = Auth::user();
            if ($user->HasRoles('admin')) {
        return redirect()->route('admin.page');
    } else {
        return redirect()->route('user.page');
    }

    }   
    public function indexUser()
    {
        return view('indexUser');
    }
    public function indexAdmin()
    {
        return view('indexAdmin');
    }

}
