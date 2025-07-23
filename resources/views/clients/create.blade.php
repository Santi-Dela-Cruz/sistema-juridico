@extends('layouts.dashboard.base')

@section('content')
    <div class="main-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('clients.index') }}"><i class="bx bx-home-alt"></i></a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                            Nuevo Cliente
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                <i class="bi bi-person-plus me-2 text-primary"></i>
                                Registrar Nuevo Cliente
                            </h5>
                            <a href="{{ route('clients.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-arrow-left me-1"></i>
                                Volver al listado
                            </a>

                        </div>
                    </div>

                    <div class="card-body p-5">
                        <form action="{{ route('clients.store') }}" method="POST" id="clientForm">
                            @csrf

                            <!-- Información General -->
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-info-circle me-2 text-info"></i>
                                    Información General
                                </h6>
                                @include('clients.partials.form')
                            </div>

                            <!-- Botones de acción -->
                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Los campos marcados con <span class="text-danger">*</span> son obligatorios
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('clients.index') }}" class="btn btn-outline-danger">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Guardar Cliente
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert para mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>

    <!-- Script para validación adicional -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('clientForm');

            form.addEventListener('submit', function(e) {
                const submitButton = form.querySelector('button[type="submit"]');

                // Deshabilitar botón para evitar doble envío
                submitButton.disabled = true;
                submitButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1" role="status"></span>Guardando...';

                // Reactivar después de 3 segundos por si hay error
                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML =
                        '<i class="bi bi-check-circle me-1"></i>Guardar Cliente';
                }, 3000);
            });
        });
    </script>
@endsection
