<?php

namespace App\Http\Controllers\simrs\display;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IgdController extends Controller
{
    public function index()
    {
        return view('SIMRS.display.displayIgd');
    }
}
