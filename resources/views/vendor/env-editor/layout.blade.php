<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ app()->getLocale() }}" xml:lang="{{ config('app.locale') }}" itemscope
    itemtype="http://schema.org/WebSite">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('env-editor::env-editor.menuTitle')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="dist/env_editor/css/bootstrap.css">
    <link rel="stylesheet" href="dist/env_editor/css/fontawesome.css">

    @stack('styles')
</head>

<body>
    <div id="app" class="container-fluid ">

        <div id="body-wrapper" class="py-5 px-2">
            <h2 class="mb-4">@stack('documentTitle')</h2>
            <main class="" role="main" itemprop="mainContentOfPage" itemscope
                itemtype="http://schema.org/Table">
                @yield('content')
            </main>
        </div>

    </div>


    <span class="javascripts">
        <script src="dist/env_editor/js/jquery.slim.min.js"></script>
        <script src="dist/env_editor/js/bootstrap.bundle.min.js"></script>
        <script src="dist/env_editor/js/vuejs2.js"></script>
        @stack('scripts')

    </span>
</body>

</html>
