<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht Allergenen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Overzicht Allergenen</h1>
        
        @if($product)
            <div class="mb-4">
                <p><strong>Naam:</strong> {{ $product->Naam }}</p>
                <p><strong>Barcode:</strong> {{ $product->Barcode }}</p>
            </div>
            
            @if (count($allergenen) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Omschrijving</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allergenen as $allergeen)
                            <tr>
                                <td>{{ $allergeen->Naam }}</td>
                                <td>{{ $allergeen->Omschrijving }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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