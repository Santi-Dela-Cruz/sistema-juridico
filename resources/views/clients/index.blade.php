<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('clients.create') }}"
                class="mb-4 inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                + Nuevo Cliente
            </a>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Identificación</th>
                            <th class="px-4 py-2 text-left">Tipo</th>
                            <th class="px-4 py-2 text-left">Teléfono</th>
                            <th class="px-4 py-2 text-left">Correo</th>
                            <th class="px-4 py-2 text-left">Estado</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($clients as $client)
                            <tr>
                                <td class="px-4 py-2">{{ $client->full_name }}</td>
                                <td class="px-4 py-2">{{ $client->identification_number }}</td>
                                <td class="px-4 py-2">{{ ucfirst($client->person_type) }}</td>
                                <td class="px-4 py-2">{{ $client->phone_number }}</td>
                                <td class="px-4 py-2">{{ $client->email }}</td>
                                <td class="px-4 py-2">
                                    @if ($client->is_active)
                                        <span class="text-green-600">Activo</span>
                                    @else
                                        <span class="text-red-600">Inactivo</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <a href="{{ route('clients.show', $client) }}"
                                        class="text-blue-500 hover:underline">Ver</a>
                                    <a href="{{ route('clients.edit', $client) }}"
                                        class="text-yellow-500 hover:underline">Editar</a>
                                    <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar cliente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($clients->isEmpty())
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center text-gray-500">No hay clientes
                                    registrados.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
