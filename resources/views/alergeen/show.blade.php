<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Overzicht Allergenen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
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
            </div>
        </div>
    </div>
</x-app-layout>