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
        
        @if($leverancier)
            <h2>Leverancier Details</h2>
            <div class="mb-4">
                <p><strong>Naam leverancier:</strong> {{ $leverancier->Naam }}</p>
                <p><strong>Contactpersoon leverancier:</strong> {{ $leverancier->ContactPersoon }}</p>
                <p><strong>Leveranciernummer:</strong> {{ $leverancier->LeverancierNummer }}</p>
                <p><strong>Mobiel:</strong> {{ $leverancier->Mobiel }}</p>
            </div>

            <h2>Product Details</h2>
            @if($hasStock && count($product) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Naam Product</th>
                            <th>Datum laatste Levering</th>
                            <th>Aantal</th>
                            <th>Eerste volgende levering</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $productItem)
                            <tr>
                                <td>{{ $productItem->Naam }}</td>
                                <td>{{ $productItem->DatumLevering }}</td>
                                <td>{{ $productItem->Aantal }}</td>
                                <td>{{ $productItem->DatumEerstVolgendeLevering ?? 'Onbekend' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif(!$hasStock && count($product) > 0)
                @php
                    $nextDelivery = collect($product)->where('DatumEerstVolgendeLevering', '!=', null)->first();
                    $deliveryDate = $nextDelivery ? \Carbon\Carbon::parse($nextDelivery->DatumEerstVolgendeLevering)->format('d-m-Y') : '30-04-2023';
                @endphp
                <div class="alert alert-warning" id="no-stock-message">
                    Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: {{ $deliveryDate }}
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = '/warehouse';
                    }, 4000);
                </script>
            @else
                <div class="alert alert-warning" id="no-stock-message">
                    Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: 30-04-2023
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = '/warehouse';
                    }, 4000);
                </script>
            @endif
        @else
            <div class="alert alert-danger" id="no-supplier-message">
                Geen leverancier gevonden voor dit product.
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