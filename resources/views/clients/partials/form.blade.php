@php
    $client = $client ?? null;
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label for="full_name" class="form-label">Nombre completo <span class="text-danger">*</span></label>
        <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $client->full_name ?? '') }}"
            required class="form-control @error('full_name') is-invalid @enderror">
        @error('full_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="identification_type" class="form-label">Tipo de identificación <span
                class="text-danger">*</span></label>
        <select name="identification_type" id="identification_type"
            class="form-select @error('identification_type') is-invalid @enderror" required>
            <option value="">Seleccione...</option>
            @foreach (['Cédula', 'RUC', 'Pasaporte'] as $type)
                <option value="{{ $type }}" @selected(old('identification_type', $client->identification_type ?? '') == $type)>{{ $type }}</option>
            @endforeach
        </select>
        @error('identification_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="person_type" class="form-label">Tipo de persona <span class="text-danger">*</span></label>
        <select name="person_type" id="person_type" class="form-select @error('person_type') is-invalid @enderror"
            required>
            <option value="">Seleccione...</option>
            @foreach (['natural', 'jurídica'] as $type)
                <option value="{{ $type }}" @selected(old('person_type', $client->person_type ?? '') == $type)>{{ ucfirst($type) }}</option>
            @endforeach
        </select>
        @error('person_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="identification_number" class="form-label">Número de identificación <span
                class="text-danger">*</span></label>
        <input type="text" name="identification_number" id="identification_number"
            value="{{ old('identification_number', $client->identification_number ?? '') }}" required
            class="form-control @error('identification_number') is-invalid @enderror">
        @error('identification_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="address" class="form-label">Dirección</label>
        <input type="text" name="address" id="address" value="{{ old('address', $client->address ?? '') }}"
            class="form-control">
    </div>

    <div class="col-md-6">
        <label for="phone_number" class="form-label">Número de teléfono</label>
        <input type="text" name="phone_number" id="phone_number"
            value="{{ old('phone_number', $client->phone_number ?? '') }}" class="form-control">
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
        <input type="email" name="email" id="email" value="{{ old('email', $client->email ?? '') }}" required
            class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="is_active" class="form-label">Estado</label>
        <select name="is_active" id="is_active" class="form-select">
            <option value="1" @selected(old('is_active', $client->is_active ?? true) == true)>Activo</option>
            <option value="0" @selected(old('is_active', $client->is_active ?? false) == false)>Inactivo</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="registered_at" class="form-label">Fecha de registro</label>
        <input type="date" name="registered_at" id="registered_at"
            value="{{ old('registered_at', optional($client->registered_at ?? null)->format('Y-m-d')) }}"
            class="form-control">
    </div>

    <!-- Campos específicos para persona natural -->
    <div class="col-md-6" id="marital_status_field" style="display: none;">
        <label for="marital_status" class="form-label">Estado civil</label>
        <select name="marital_status" id="marital_status" class="form-select">
            <option value="">Seleccione...</option>
            @foreach (['Soltero/a', 'Casado/a', 'Divorciado/a', 'Viudo/a', 'Unión libre'] as $status)
                <option value="{{ $status }}" @selected(old('marital_status', $client->marital_status ?? '') == $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>

    <!-- Campos específicos para persona jurídica -->
    <div class="col-md-6" id="legal_representative_field" style="display: none;">
        <label for="legal_representative" class="form-label">Representante legal</label>
        <input type="text" name="legal_representative" id="legal_representative"
            value="{{ old('legal_representative', $client->legal_representative ?? '') }}" class="form-control">
    </div>

    <div class="col-md-6" id="fiscal_address_field" style="display: none;">
        <label for="fiscal_address" class="form-label">Dirección fiscal</label>
        <input type="text" name="fiscal_address" id="fiscal_address"
            value="{{ old('fiscal_address', $client->fiscal_address ?? '') }}" class="form-control">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const personTypeSelect = document.getElementById('person_type');
        const maritalStatusField = document.getElementById('marital_status_field');
        const legalRepresentativeField = document.getElementById('legal_representative_field');
        const fiscalAddressField = document.getElementById('fiscal_address_field');

        function toggleFields() {
            const personType = personTypeSelect.value;

            if (personType === 'natural') {
                maritalStatusField.style.display = 'block';
                legalRepresentativeField.style.display = 'none';
                fiscalAddressField.style.display = 'none';
            } else if (personType === 'jurídica') {
                maritalStatusField.style.display = 'none';
                legalRepresentativeField.style.display = 'block';
                fiscalAddressField.style.display = 'block';
            } else {
                maritalStatusField.style.display = 'none';
                legalRepresentativeField.style.display = 'none';
                fiscalAddressField.style.display = 'none';
            }
        }

        // Ejecutar al cargar la página
        toggleFields();

        // Ejecutar cuando cambie el tipo de persona
        personTypeSelect.addEventListener('change', toggleFields);
    });
</script>
