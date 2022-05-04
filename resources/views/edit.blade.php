@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit account') }}</div>

                    <div class="card-body">
                        <form action="{{ route("home.edit.name") }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="userName">Your Name</label>
                                <input type="text" name="userName" class="form-control" id="userName" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" aria-describedby="emailHelp" placeholder="Enter name">
                                <small id="userName" class="form-text text-muted"></small>
                            </div>
                            <button type="submit" class="btn btn-dark">Save</button>

                        </form>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
