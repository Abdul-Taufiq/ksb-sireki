@extends('errors::layout')

@section('title', __('Error 503'))

@section('error-content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <center>
                <img style="width: 270px; height: 200px;" src="{{ asset('img/error_image/maintenance.gif') }}" alt="Error">
            </center>

            <div class="header">
                <h3 class="text-warning">{{ strtoupper('site is under maintenance!') }}</h3>
            </div>

            <div class="title">
                <strong class="text-danger">503</strong>|<small class="text-danger"
                    style="letter-spacing: 2px;">{{ strtoupper('Service Unavailable') }}</small>
            </div>

            <div class="detail_content">
                Service is currently under maintenance, please try again later or contact your web
                developer
            </div>

            <br>
            <a class="btn btn-outline-primary" href="{{ url()->previous() }}">
                <i class="fa-solid fa-arrow-left"></i> &nbsp; Go Back
                to Previous Page
            </a>

        </div>
    </div>

@endsection
