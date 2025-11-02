<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht Magazijn Jamin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href=".../css/style.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Overzicht Magazijn Jamin</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Barcode</th>
                    <th class="text-center">Naam</th>
                    <th class="text-center">VerpakkingsEenheid</th>
                    <th class="text-center">AantalAanwezig</th>
                    <th class="text-center">Allergenen Info</th>
                    <th class="text-center">Leverantie Info</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        <td class="text-center">{{ $item->Barcode }}</td>
                        <td class="text-center">{{ $item->Naam }}</td>
                        <td class="text-center">{{ $item->VerpakkingsEenheid }}</td>
                        <td class="text-center">{{ $item->AantalAanwezig }}</td>
                        <td class="text-center">
                            <a href="/alergeen/{{ $item->Id }}" class="bi bi-x-lg text-danger" style="font-size: 1.2em; text-decoration: none;"></a>
                        </td>
                        <td class="text-center">
                            <a href="/leverancier/{{ $item->Id }}" class="bi bi-question-lg text-primary" style="font-size: 1.2em; text-decoration: none;"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>