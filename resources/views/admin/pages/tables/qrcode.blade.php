
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width={device-width}, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __("QR Code") }}</title>
</head>
<body>
    <div style="text-align:center">
        {!! $qrcode !!}
        <p>{{$uri}}</p>
    </div>
</body>
</html>