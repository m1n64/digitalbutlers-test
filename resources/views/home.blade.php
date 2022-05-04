@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <div>
                            @foreach ($errors->all() as $error)
                                <p><strong>{{ $error }}</strong></p>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="card-header">{{ __('Books List') }}</div>

                <div class="card-body">
                    <div class="data-list">
                        @foreach($books as $book)
                            <div class="data-element-wrapper">
                                <div class="data-element">
                                    <form class="data-element-form" action="{{ route("books.edit", $book->id) }}" method="post">
                                        @csrf
                                        <input class="form-control" type="text" value="{{ $book->name }}" name="bookName">
                                        <input class="form-control" type="date" value="{{ $book->year }}" name="bookYear">
                                        <button class="btn btn-light">Save</button>
                                    </form>
                                    <form class="data-element-form" action="{{ route("books.delete", $book->id) }}" method="get">
                                        <button class="btn btn-light deleteAuthor" data-id="{{ $book->id }}">Delete</button>
                                    </form>

                                </div>
                                <div>
                                    <h6>Authors:</h6>
                                    <ul class="data-list">
                                        @foreach($book->authors as $author)
                                            <li class="list-group-item">
                                                <input type="text" disabled value="{{ $author->name }}">

                                                <form class="data-element-form" action="{{ route("authors.delete.book", [$author->id, $book->id]) }}" method="get">
                                                    <button class="btn btn-light deleteAuthor" data-id="{{ $author->id }}">Unlink</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                   </div>
                </div>


                <div class="card-header">{{ __('Books') }}</div>

                <div class="card-body">
                    <form action="{{ route("books.add") }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="bookName">Book Name</label>
                            <input type="text" name="bookName" class="form-control" id="bookName" aria-describedby="emailHelp" placeholder="Enter book name">
                            <small id="bookName" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="bookYear">Book Year</label>
                            <input type="date" name="bookYear" class="form-control" id="bookYear" aria-describedby="emailHelp" placeholder="Enter book name">
                            <small id="bookYear" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-dark">Add</button>
                    </form>
                </div>

                <div class="card-header">{{ __('Authors') }}</div>


                <div class="card-body">

                    <div class="data-list">
                        <h6>Authors:</h6>
                            @foreach($authors as $author)
                                <div class="data-element">
                                    <form class="data-element-form" action="{{ route("authors.edit", $author->id) }}" method="post">
                                        @csrf
                                        <input class="form-control" type="text" value="{{ $author->name }}" name="authorName">

                                        <button class="btn btn-light">Save</button>
                                    </form>

                                    <form class="data-element-form" action="{{ route("authors.delete", $author->id) }}" method="get">
                                        <button class="btn btn-light deleteAuthor" data-id="{{ $author->id }}">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                    </div>

                    <form action="{{ route("authors.add") }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="authorName">Author Name</label>
                            <input type="text" name="authorName" class="form-control" id="authorName" aria-describedby="emailHelp" placeholder="Enter name">
                            <small id="authorName" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-dark">Add</button>
                    </form>

                </div>

                <div class="card-header">Link book with author:</div>

                <div class="card-body">

                    <form action="{{ route("books.link") }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="bookId">Book:</label>
                            <br>
                            <select name="bookId" id="bookId">
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="authorId">Author:</label>
                            <br>
                            <select name="authorId" id="authorId">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark">Link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
