<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KSB | {{ $title }}</title>


    {{-- THEME INIT --}}
    <script>
        (() => {
            'use strict';

            const STORAGE_KEY = 'lte-theme';
            let stored = null;

            try {
                stored = localStorage.getItem(STORAGE_KEY);
            } catch {
                // localStorage mungkin tidak tersedia
            }

            const prefersDark =
                globalThis.matchMedia('(prefers-color-scheme: dark)').matches;

            let resolved = 'light';

            if (stored === 'dark' || stored === 'light') {
                resolved = stored;
            } else if (prefersDark) {
                resolved = 'dark';
            }

            document.documentElement.setAttribute(
                'data-bs-theme',
                resolved
            );

            document.documentElement.style.colorScheme = resolved;
        })();
    </script>

    {{-- META --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <meta name="supported-color-schemes" content="light dark" />

    {{-- PRELOAD CSS --}}
    <link rel="preload" href="{{ asset('template/css/adminlte.min.css') }}" as="style" />

    {{-- FONT --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media = 'all'" />

    {{-- OVERLAY SCROLLBARS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />


    {{-- BOOTSTRAP ICONS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />

    {{-- SUMMERNOTE CSS --}}
    <link rel="stylesheet" href="{{ asset('template/summernote/summernote-bs5.min.css') }}" />

    {{-- FAVICON --}}
    <link rel="shortcut icon" href="{{ asset('img/logo-ksb.png') }}" />
    <link rel="icon" href="{{ asset('img/logo-ksb.png') }}" />

    {{-- CORE CSS --}}
    <link rel="stylesheet" href="{{ asset('template/css/adminlte.min.css') }}" />

    {{--  CUSTOM CSS --}}
    @stack('wire-style')
    @yield('style')
    <style>
        .active {
            background-color: rgba(0, 140, 255, 0.145) !important;
        }

        .btn-table {
            width: 30px !important;
            height: 30px !important;
            padding: 3px 0 0 0 !important;
        }

        label {
            font-weight: bold;
            font-size: 14px;
        }

        label:has(+ input[required])::after {
            content: "  *";
            color: red;
            font-style: italic;
        }

        label:has(+ select[required])::after {
            content: "  *";
            color: red;
            font-style: italic;
        }

        label:has(+ textarea[required])::after {
            content: " *";
            color: red;
        }

        .wajib::after {
            content: " *";
            color: red;
        }

        input {
            border-radius: 8px !important;
        }

        textarea {
            border-radius: 8px !important;
        }

        select {
            border-radius: 8px !important;
        }

        .card {
            border-radius: 8px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.357);
            width: 100%;
            position: relative;
            overflow: hidden;
            text-align: left;
        }
    </style>

</head>
