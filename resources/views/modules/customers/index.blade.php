@extends('layouts.dashboard.base')

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="ps-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Clientes
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="row g-2 align-items-center mb-3 flex-wrap">
            <form method="GET" action="{{ route('clients.index') }}"
                class="col-auto d-flex align-items-center gap-2 flex-wrap">

                {{-- Campo de búsqueda (más ancho) --}}
                <div class="position-relative" style="min-width: 250px;">
                    <input class="form-control form-control-sm ps-5 w-100" type="search" name="search"
                        placeholder="Buscar Clientes" value="{{ request('search') }}" />
                    <span class="material-icons-outlined position-absolute start-0 top-50 translate-middle-y ms-2 fs-6">
                        search
                    </span>
                </div>

                {{-- Filtro por tipo de persona (más angosto) --}}
                <select name="person_type" class="form-select form-select-sm" style="width: 140px;">
                    <option value="">Persona</option>
                    <option value="natural" {{ request('person_type') === 'natural' ? 'selected' : '' }}>Natural</option>
                    <option value="jurídica" {{ request('person_type') === 'jurídica' ? 'selected' : '' }}>Jurídica</option>
                </select>

                {{-- Filtro por estado (más angosto) --}}
                <select name="status" class="form-select form-select-sm" style="width: 130px;">
                    <option value="">Estado</option>
                    <option value="activo" {{ request('status') === 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('status') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>

                {{-- Botón Filtrar --}}
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="bi bi-funnel-fill me-1"></i>Filtrar
                </button>
            </form>

            {{-- Botón Agregar --}}
            <div class="col-auto ms-auto d-flex gap-2 flex-wrap">
                <button class="btn btn-sm btn-success" onclick="window.location.href='{{ route('clients.create') }}'">
                    <i class="bi bi-plus-lg me-1"></i>Agregar
                </button>
            </div>
        </div>



        <div class="card mt-4">
            <div class="card-body">
                <div class="customer-table">
                    <div class="table-responsive white-space-nowrap">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>
                                        <input class="form-check-input" type="checkbox" />
                                    </th>
                                    <th>Cliente</th>
                                    <th>Tipo</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Tipo</th>
                                    <th>Identificación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clients as $client)
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox" />
                                        </td>
                                        <td>
                                            {{ $client->full_name }}
                                        </td>
                                        <td>
                                            {{ $client->person_type }}
                                        </td>
                                        <td>
                                            {{ $client->email }}
                                        </td>
                                        <td>{{ $client->phone_number ?? 'N/A' }}</td>
                                        <td>
                                            {{ $client->identification_type }}
                                        </td>
                                        <td>{{ $client->identification_number }}</td>
                                        <td>
                                            @if ($client->is_active)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="btn btn-outline-info btn-sm" title="Ver">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-outline-primary btn-sm" title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm" title="Eliminar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-people fs-1 text-muted mb-3"></i>
                                                <h5 class="text-muted">No hay clientes registrados</h5>
                                                <p class="text-muted">Comienza agregando tu primer cliente</p>
                                                <button class="btn btn-primary">
                                                    <i class="bi bi-plus-lg me-2"></i>Agregar Cliente
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($clients->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                        <div class="mb-2 mb-md-0">
                            <small>
                                Mostrando {{ $clients->firstItem() }} a {{ $clients->lastItem() }} de
                                {{ $clients->total() }} resultados
                            </small>
                        </div>

                        <nav>
                            <ul class="pagination mb-0">
                                {{-- Botón anterior --}}
                                <li class="page-item {{ $clients->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $clients->previousPageUrl() }}"
                                        tabindex="-1">Anterior</a>
                                </li>

                                {{-- Links de páginas --}}
                                @for ($i = 1; $i <= $clients->lastPage(); $i++)
                                    @if ($i == $clients->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $i }}</span>
                                        </li>
                                    @elseif ($i == 1 || $i == $clients->lastPage() || ($i >= $clients->currentPage() - 1 && $i <= $clients->currentPage() + 1))
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $clients->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @elseif ($i == $clients->currentPage() - 2 || $i == $clients->currentPage() + 2)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                @endfor

                                {{-- Botón siguiente --}}
                                <li class="page-item {{ $clients->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $clients->nextPageUrl() }}">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
