<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class HomeController extends Controller
{
  # use MessageAndStatus Trait.
  use MessageStatusTrait;

  /**
   * Home page
   * @param Illuminate\Http\Request;
   * @return Illuminate\Http\Response;
   */
  public function index(Request $request)
  {
  	# return to home page
  	return view('admin.dashboard.index');
  }  
}
