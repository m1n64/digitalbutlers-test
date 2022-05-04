<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditAccountController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(Request $request)
    {
        return view("edit");
    }

    public function editName(Request $request)
    {
        $request->validate([
            "name"=>$request->get("userName")
        ]);

        User::find(Auth::id())
            ->update([
                "name"=>$request->get("userName")
            ]);

        return redirect("/home/edit");
    }
}
