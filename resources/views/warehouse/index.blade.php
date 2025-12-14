<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Overzicht Magazijn Jamin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
            </div>
        </div>
    </div>
</x-app-layout>