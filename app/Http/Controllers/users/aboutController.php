<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class aboutController extends Controller
{
  public function about()
  {
    $about = \App\Models\About::get()->first();

    return view('sites.abouts' , compact('about'));
  }
}
