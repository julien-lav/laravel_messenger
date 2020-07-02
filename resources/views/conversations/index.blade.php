@extends('layouts.app')

@section('content')
    <div class="container">
        @include('conversations.users', ['users' => $users])
        <div class="col-md-3">
            <div class="list-group">
            
            </div>
        </div>
    </div>
@endsection