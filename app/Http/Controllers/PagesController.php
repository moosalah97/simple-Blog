<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PagesController extends Controller
{
    //
    public function about(){
    return view('pages.about');
    }

    public function home(){

        return view('pages.home');
    }

    public function services(){
        return view('pages.services');
    }
}
