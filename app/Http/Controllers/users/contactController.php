<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class contactController extends Controller
{
  public function contact()
  {
    $ask = \App\Models\Ask::get();
    return view('sites.contact' ,compact('ask'));
  }
}
