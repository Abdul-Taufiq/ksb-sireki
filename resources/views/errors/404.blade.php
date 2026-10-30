@extends('errors::layout')

@section('title', __('Not Found'))

@section('error-content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <center>
                <img style="width: 250px; height: 250px;" src="{{ asset('img/error_image/missing-page.gif') }}" alt="Error">
            </center>

            <div class="header">
                <h3 class="text-warning">{{ strtoupper('there is an error!') }}</h3>
            </div>

            <div class="title">
                <strong class="text-danger">404</strong>|<small class="text-danger"
                    style="letter-spacing: 2px;">{{ strtoupper('Not found') }}</small>
            </div>

            <div class="detail_content">
                It seems like the page you are looking for is not found, try to contact the website application
                developer, or you can return to the previous page.
            </div>

            <br>
            <a class="btn btn-outline-primary" href="{{ url()->previous() }}">
                <i class="fa-solid fa-arrow-left"></i> &nbsp; Go Back
                to Previous Page
            </a>

        </div>
    </div>

@endsection
