<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AlurLayanan</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .poster {
            width: 297mm;
            height: 210mm;
        }
    </style>

</head>

<body>
<div class="poster">
    @if($id == '1')
    <img src="{{ public_path('img/upscalemedia-transformed (6).jpeg') }}" style="width:100%; height:100%;">
    @endif
    @if($id == '2')
    <img src="{{ public_path('img/upscalemedia-transformed (2).jpeg') }}" style="width:100%; height:100%;">
    @endif
    @if($id == '3')
    <img src="{{ public_path('img/upscalemedia-transformed (3).jpeg') }}" style="width:100%; height:100%;">
    @endif
    @if($id == '4')
    <img src="{{ public_path('img/upscalemedia-transformed (4).jpeg') }}" style="width:100%; height:100%;">
    @endif
    @if($id == '5')
    <img src="{{ public_path('img/upscalemedia-transformed (5).jpeg') }}" style="width:100%; height:100%;">
    @endif
</div>

</body>

</html>
