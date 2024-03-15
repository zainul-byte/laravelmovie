@extends('layouts.creator')

@section('title', 'Dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin">

            @if (session('message'))
                <h2 class="alert alert-success">{{ session('message') }},</h2>
            @endif
            <div class="me-md-3 me-xl-5">
                <h2>Dashboard,</h2>
                <p class="mb-md-0">Your analytics dashboard template.</p>
                <hr>
            </div>

        </div>
    </div>

@endsection
