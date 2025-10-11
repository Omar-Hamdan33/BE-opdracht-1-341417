<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href=".../css/style.css">
</head>
<body>
    <h1>{{ $title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Barcode</th>
                <th>Naam</th>
                <th>VerpakkingsEenheid</th>
                <th>Location</th>
                <th>Alergeen info</th>
                <th>leverancier info</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->Barcode }}</td>
                    <td>{{ $item->Naam }}</td>
                    <td>{{ $item->VerpakkingsEenheid }}</td>
                    <td>{{ $item->AantalAanwezig }}</td>
                    <td><a href="/alergeen/{{ $item->Id }}" class="bi bi-question-lg"></a></td>
                    <td><a href="/leverancier/{{ $item->Id }}" class="bi bi-x-lg"></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>