<?php

namespace App\Http\Controllers;

// namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;

use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
        
    //     return view('home');
    // }
    public function index()
    {
        if (Gate::allows('users_manage')) {
            return view('home');
        } elseif (Gate::allows('user')) {
            return view("user.home_member");
        } else{
            return view("user.home_guest");
        }
    }
}
