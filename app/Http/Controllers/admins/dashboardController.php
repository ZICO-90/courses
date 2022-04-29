<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
 
    public  function home()
    {
        return view('dashboardAdmins.layout_admin');
    }
}
