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
    <title>{{ $config['appName'] }}</title>
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}",
            appName: "{{ $config['appName'] }}",
            locale: "{{ $config['locale'] }}",
        }
        // window.config = {
        //     appName: "{{ $config['appName'] }}"
        // }
    </script>
    <link rel="stylesheet" href="{{ $appCss }}">
</head>

<body>
    <div id="app"></div>

    @if (env('APP_ENV') == 'production')
        <script type="text/javascript">
            console.clear()
            console.log('%c Stop!', 'color: #f00; font-size: 60px; font-weight: bold;');
            console.log(
                '%c Il s’agit d’une fonctionnalité de navigateur conçue pour les développeurs. Si quelqu’un vous a invité(e) à copier-coller quelque chose ici pour activer une fonctionnalité ou soit-disant pirater le compte d’un tiers, sachez que c’est une escroquerie permettant à cette personne d’accéder à votre compte. \nToute action ayant pour but de porter préjudice à l\'application PowerControl ou aux serveurs de la BNA sera automatiquement considérée comme une cybercriminalité et sera punie par la loi.',
                'font-size: 25px;');
        </script>
    @endif
    <script src="{{ $appJs }}"></script>
    <script>
        window.config = @json($config);
    </script>
    {{-- <script src="chartjs-plugin-colorschemes.js"></script> --}}
</body>

</html>
