<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Levering Informatie
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        @if($leverancier)
            <div class="mb-4">
                <p><strong>Naam leverancier:</strong> {{ $leverancier->Naam }}</p>
                <p><strong>Contactpersoon leverancier:</strong> {{ $leverancier->ContactPersoon }}</p>
                <p><strong>Leverancier nummer:</strong> {{ $leverancier->LeverancierNummer }}</p>
                <p><strong>Mobiel:</strong> {{ $leverancier->Mobiel }}</p>
            </div>

            @if($hasStock && count($product) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Naam Product</th>
                            <th class="text-center">Datum laatste levering</th>
                            <th class="text-center">Aantal</th>
                            <th class="text-center">Eerstvolgende levering</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $productItem)
                            <tr>
                                <td class="text-center">{{ $productItem->Naam }}</td>
                                <td class="text-center">{{ $productItem->DatumLevering }}</td>
                                <td class="text-center">{{ $productItem->Aantal }}</td>
                                <td class="text-center">{{ $productItem->DatumEerstVolgendeLevering ?? 'Onbekend' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif(!$hasStock && count($product) > 0)
                @php
                    $nextDelivery = collect($product)->where('DatumEerstVolgendeLevering', '!=', null)->first();
                    $deliveryDate = $nextDelivery ? $nextDelivery->DatumEerstVolgendeLevering : '30/04/2023';
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
                    Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: 30/04/2023
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
            </div>
        </div>
    </div>
</x-app-layout>