<?php

namespace Steppoll\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageSteppollController extends Controller
{


    public function index()
    {
        return view('steppoll::page');
    }
}
