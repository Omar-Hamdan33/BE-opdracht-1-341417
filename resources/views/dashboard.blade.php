<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jamin Magazijn Systeem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Welkom bij Jamin Magazijn Systeem</h3>
                    <p class="text-gray-600 mb-6">Beheer uw magazijn en bekijk product informatie</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                            <h4 class="text-lg font-semibold text-blue-800 mb-2">Magazijn Overzicht</h4>
                            <p class="text-blue-600 mb-4">Bekijk alle producten in het magazijn, inclusief voorraad, allergenen en leverancier informatie.</p>
                            <a href="{{ route('warehouse.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ga naar Overzicht Magazijn Jamin
                            </a>
                        </div>
                        
                        <div class="bg-green-50 p-6 rounded-lg border border-green-200">
                            <h4 class="text-lg font-semibold text-green-800 mb-2">Overzicht leveranciers</h4>
                            <p class="text-green-600 mb-4">Bekijk alle leveranciers en hun geleverde producten aan Jamin.</p>
                            <a href="{{ route('warehouse.leveranciers') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ga naar Overzicht Leveranciers
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
