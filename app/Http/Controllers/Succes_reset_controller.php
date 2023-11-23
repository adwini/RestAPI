<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;
class SuccesController extends Controller {

    public function view()
    {
        return view('success');
    }
}
