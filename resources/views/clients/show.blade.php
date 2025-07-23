<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Detalle Cliente') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <p><strong>Nombre:</strong> {{ $client->full_name }}</p>
                <p><strong>Tipo identificación:</strong> {{ $client->identification_type }}</p>
                <p><strong>Tipo persona:</strong> {{ $client->person_type }}</p>
                <p><strong>Número:</strong> {{ $client->identification_number }}</p>
                <p><strong>Dirección:</strong> {{ $client->address }}</p>
                <p><strong>Teléfono:</strong> {{ $client->phone_number }}</p>
                <p><strong>Correo:</strong> {{ $client->email }}</p>
                <p><strong>Estado:</strong> {{ $client->is_active ? 'Activo' : 'Inactivo' }}</p>
                <p><strong>Registrado:</strong> {{ $client->registered_at }}</p>

                @if ($client->person_type === 'natural')
                    <p><strong>Estado civil:</strong> {{ $client->marital_status }}</p>
                @else
                    <p><strong>Representante legal:</strong> {{ $client->legal_representative }}</p>
                    <p><strong>Dirección fiscal:</strong> {{ $client->fiscal_address }}</p>
                @endif

                <div class="mt-4">
                    <a href="{{ route('clients.index') }}" class="text-blue-500 hover:underline">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
