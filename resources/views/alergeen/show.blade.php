<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
    <div class="container mt-4">
        <h1>{{ $title }}</h1>
        
        @if($product)
            <div class="mb-4">
                <p><strong>Naam Product:</strong> {{ $product->Naam }}</p>
                <p><strong>Barcode:</strong> {{ $product->Barcode }}</p>
            </div>
            
            <h2>Allergenen:</h2>
            @if (count($allergenen) > 0)
                <ul class="list-group">
                    @foreach ($allergenen as $allergeen)
                        <li class="list-group-item">{{ $allergeen->Naam }}</li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-success" id="no-allergens-message">
                    In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = '/warehouse';
                    }, 4000);
                </script>
            @endif
        @else
            <div class="alert alert-danger">
                Product niet gevonden.
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = '/warehouse';
                }, 4000);
            </script>
        @endif
        
        <a href="/warehouse" class="btn btn-secondary mt-3">Terug naar overzicht</a>
    </div>
</body>
</html>