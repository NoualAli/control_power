@php
    $config = [
        'appName' => config('app.name'),
        'locale' => ($locale = app()->getLocale()),
        'locales' => config('app.locales'),
    ];
    $appJs = mix('dist/js/app.js');
    $appCss = mix('dist/css/app.css');
@endphp
<!DOCTYPE html>
<html lang="{{ $config['locale'] }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('images/logo_p.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>{{ $config['appName'] }}</title>
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}",
            // jsPermissions: {!! auth()->check();
            //     ? auth()->user()->role()
            //     : 0 !!}
        }
    </script>
    <link rel="stylesheet" href="{{ $appCss }}">
</head>

<body>
    <div id="app"></div>

    <script>
        window.config = @json($config);
    </script>
    {{-- <script src="chartjs-plugin-colorschemes.js"></script> --}}
    <script src="{{ $appJs }}"></script>
</body>

</html>
