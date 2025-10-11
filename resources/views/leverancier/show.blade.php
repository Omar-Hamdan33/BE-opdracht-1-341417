<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <h2>Leverancier Details</h2>
    <p><strong>Name:</strong> {{ $leverancier[0]->Naam }}</p>
    <p><strong>Contact Person:</strong> {{ $leverancier[0]->ContactPersoon }}</p>
    <p><strong>Leverancier Number:</strong> {{ $leverancier[0]->LeverancierNummer }}</p>
    <p><strong>Mobile:</strong> {{ $leverancier[0]->Mobiel }}</p>

    <h2>Product Details</h2>
    <table>
        <thead>
        <tr>
            <th>Naam Product</th>
            <th>Datum laatste Levering</th>
            <th>Aantal</th>
            <th>Eerste volgende levering</th>
        </tr>
        </thead>
        <tbody>
        @foreach($product as $products)
            <tr>
                <td>{{ $products->Naam }}</td>
                <td>{{ $products->DatumLevering }}</td>
                <td>{{ $products->Aantal }}</td>
                <td>{{ $products->DatumEerstVolgendeLevering }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>