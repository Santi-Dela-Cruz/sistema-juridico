<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ route('clients.update', $client) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('clients.partials.form', ['client' => $client])

                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                            Actualizar
                        </button>
                        <a href="{{ route('clients.index') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
