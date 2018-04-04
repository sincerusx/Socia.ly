@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('verify'))
                        <div class="alert alert-warning">
                            {{ session('verify') }}
                        </div>
                    @endif

                    Hello <strong>{{Auth::user()->username}}</strong>. You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
