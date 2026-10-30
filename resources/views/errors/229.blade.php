{{-- for block access permission --}}

@extends('errors::layout')

@section('title', __('Error 229'))

@section('error-content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <center>
                <img style="width: 250px; height: 250px;" src="{{ asset('img/error_image/error-page.gif') }}" alt="Error">
            </center>

            <div class="header">
                <h3 class="text-warning">{{ strtoupper('there is an error!') }}</h3>
            </div>

            <div class="title">
                <strong class="text-danger">229</strong> |
                <small class="text-danger"
                    style="letter-spacing: 2px;">{{ strtoupper($exception->getMessage() ?? 'Abort Access') }}</small>
            </div>

            <div class="detail_content">
                Access to this page or resource is denied from server! <br>
                Please contact the administrator or your system administrator for further assistance.
            </div>

            <br>
            <a class="btn btn-outline-primary" href="{{ url()->previous() }}">
                <i class="fa-solid fa-arrow-left"></i> &nbsp; Go Back
                to Previous Page
            </a>

        </div>
    </div>

@endsection
