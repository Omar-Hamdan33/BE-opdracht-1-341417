<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Geleverde producten
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        
        @if($leverancier)
            <div class="mb-4">
                <p><strong>Leverancier:</strong> {{ $leverancier->Naam }}</p>
                <p><strong>Contact persoon:</strong> {{ $leverancier->ContactPersoon }}</p>
                <p><strong>Leverancier nummer:</strong> {{ $leverancier->LeverancierNummer }}</p>
                <p><strong>Mobiel:</strong> {{ $leverancier->Mobiel }}</p>
            </div>

            @if(count($producten) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Naam product</th>
                            <th class="text-center">Aantal in magazijn</th>
                            <th class="text-center">Verpakkings eenheid</th>
                            <th class="text-center">Laatste levering</th>
                            <th class="text-center">Nieuwe levering</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($producten as $product)
                            <tr>
                                <td class="text-center">{{ $product->Naam }}</td>
                                <td class="text-center">{{ $product->AantalInMagazijn ?? 0 }}</td>
                                <td class="text-center">-</td>
                                <td class="text-center">{{ $product->LaatsteLevering }}</td>
                                <td class="text-center">
                                    <a href="{{ route('warehouse.nieuwe-levering', ['leverancierId' => $leverancierId, 'productId' => $product->Id]) }}" 
                                       class="bi bi-plus-lg text-success" style="font-size: 1.2em; text-decoration: none;"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning" id="no-products-message">
                    Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = '{{ route('warehouse.leveranciers') }}';
                    }, 3000);
                </script>
            @endif
        @else
            <div class="alert alert-danger">
                Leverancier niet gevonden.
            </div>
        @endif
        
        <a href="{{ route('warehouse.leveranciers') }}" class="btn btn-secondary mt-3">Terug naar overzicht leveranciers</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>