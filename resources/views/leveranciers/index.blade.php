<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Overzicht leveranciers
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
                    <th class="text-center">Naam</th>
                    <th class="text-center">Contact persoon</th>
                    <th class="text-center">Leverancier nummer</th>
                    <th class="text-center">Mobiel</th>
                    <th class="text-center">Aantal verschillende producten</th>
                    <th class="text-center">Toon producten</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leveranciers as $leverancier)
                    <tr>
                        <td class="text-center">{{ $leverancier->Naam }}</td>
                        <td class="text-center">{{ $leverancier->ContactPersoon }}</td>
                        <td class="text-center">{{ $leverancier->LeverancierNummer }}</td>
                        <td class="text-center">{{ $leverancier->Mobiel }}</td>
                        <td class="text-center">{{ $leverancier->AantalVerschillendeProducten }}</td>
                        <td class="text-center">
                            <a href="{{ route('warehouse.geleverde-producten', ['leverancierId' => $leverancier->Id]) }}" 
                               class="bi bi-box-seam text-primary" style="font-size: 1.2em; text-decoration: none;"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <a href="{{ route('warehouse.index') }}" class="btn btn-secondary mt-3">Terug naar magazijn overzicht</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>