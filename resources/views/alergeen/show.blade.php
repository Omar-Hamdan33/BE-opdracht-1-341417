<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $product->Naam }}</p>
    <p>Barcode: {{ $product->Barcode }}</p>
    <h2>Allergenen:</h2>
    <ul>
        @if (empty($allergenen))
            <li>Geen allergenen gevonden.</li>
        @else
            @foreach ($allergenen as $allergeen)
                <li>{{ $allergeen->Naam }}</li>
            @endforeach
        @endif
    </ul>

</body>
</html>