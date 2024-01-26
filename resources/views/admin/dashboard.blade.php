@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>Ciao {{ Auth::user()->name }}! Benvenuto nel tuo portfolio.</h2>
                        <p>La tua email è {{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
