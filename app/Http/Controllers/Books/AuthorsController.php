<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use App\Models\Books;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "authorName"=>["required", "string"],
            //"bookId"=>["required", "integer"]
        ]);

        Authors::create([
            "name"=>$request->get("authorName"),
            //"books_id"=> $request->get("bookId")
        ]);

        return redirect("home");
    }

    public function delete(Request $request, $id)
    {
        $author = Authors::with("books")
            ->find($id);

        $author->books()->detach(Books::find($author->books));

        $author->delete();

        return redirect("home");
    }

    public function edit(Request $request, $id)
    {
        $validator = $request->validate([
            "authorName"=>["required", "string"]
        ]);

        Authors::find($id)
            ->update([
                "name"=>$request->get("authorName")
            ]);

        return redirect("home");
    }

    public function deleteFromBook(Request $request, $id, $book_id)
    {
        $book = Books::with("authors")
            ->find($book_id);

        $book->authors()->detach(Authors::find($id));

        return redirect("home");
    }

}
