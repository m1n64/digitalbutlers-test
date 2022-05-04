<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "bookName"=>["required", "string"],
            "bookYear"=>["required", "date"],
            //"authorId"=>["required", "integer"]
        ]);

        $book = Books::create([
            "name"=>$request->get("bookName"),
            "year"=>$request->get("bookYear"),
        ]);

        //$book->authors()->attach(Authors::find($request->get("authorId")));

        return redirect("home");
    }

    public function delete(Request $request, $id)
    {
        $book = Books::with("authors")
            ->find($id);
        $book->authors()
            ->detach(Authors::find($book->authors));

        $book->delete();
        return redirect("home");
    }

    public function edit(Request $request, $id)
    {
        $validator = $request->validate([
            "bookName"=>["required", "string"],
            "bookYear"=>["required", "date"]
        ]);

        Books::find($id)
            ->update([
                "name"=>$request->get("bookName"),
                "year"=>$request->get("bookYear")
            ]);
        return redirect("home");
    }

    public function linkWithAuthor(Request $request)
    {
        $validator = $request->validate([
            "bookId"=>["required", "integer"],
            "authorId"=>["required", "integer"],
        ]);

        Books::find($request->get("bookId"))
            ->authors()
            ->attach(Authors::find($request->get("authorId")));

        return redirect("home");
    }
}
