@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Books list') }}</div>
                        <ul class="list-group list-group-flush">
                            @foreach($books as $book)
                                <li class="list-group-item">
                                    <strong>{{ $book->name }} - {{ \Carbon\Carbon::parse($book->year)->format("Y") }}</strong>
                                    <ul class="list-group list-group-flush">
                                        @foreach($book->authors as $author)
                                            <li class="list-group-item">{{ $author->name }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
