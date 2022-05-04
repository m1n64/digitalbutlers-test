<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        $books = Books::with("authors")
            ->get();
        return view("index", ["books"=>$books]);
    }
}
