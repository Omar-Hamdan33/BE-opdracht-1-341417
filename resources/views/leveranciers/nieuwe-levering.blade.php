<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Levering product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        @if(isset($errorMessage))
            <div class="alert alert-danger" id="error-message">
                {{ $errorMessage }}
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = '{{ route('warehouse.geleverde-producten', ['leverancierId' => $leverancierId]) }}';
                }, 4000);
            </script>
        @else
            @if($leverancier && $product)
                <div class="mb-4">
                    <p><strong>Leverancier:</strong> {{ $leverancier->Naam ?? 'Onbekend' }}</p>
                    <p><strong>Product:</strong> {{ $product->Naam ?? 'Onbekend' }}</p>
                </div>

                <form action="{{ route('warehouse.store-levering') }}" method="POST">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="hidden" name="leverancier_id" value="{{ $leverancierId }}">
                    <input type="hidden" name="product_id" value="{{ $productId }}">
                    
                    <div class="mb-3">
                        <label for="aantal" class="form-label"><strong>Aantal producteenheden</strong></label>
                        <input type="number" class="form-control" id="aantal" name="aantal" required min="1">
                    </div>
                    
                    <div class="mb-3">
                        <label for="datum_eerst_volgende_levering" class="form-label"><strong>Datum eerstvolgende levering</strong></label>
                        <input type="date" class="form-control" id="datum_eerst_volgende_levering" 
                               name="datum_eerst_volgende_levering" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Sla op</button>
                    <a href="{{ route('warehouse.geleverde-producten', ['leverancierId' => $leverancierId]) }}" 
                       class="btn btn-secondary ms-2">Annuleren</a>
                </form>
            @else
                <div class="alert alert-danger">
                    Product of leverancier niet gevonden.
                </div>
            @endif
        @endif
        
        <a href="{{ route('warehouse.geleverde-producten', ['leverancierId' => $leverancierId]) }}" 
           class="btn btn-secondary mt-3">Terug naar geleverde producten</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>