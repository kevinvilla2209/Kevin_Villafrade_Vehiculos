<div class="mb-3">
    <label for="marca" class="form-label">Marca</label>
    <input type="text" name="marca" class="form-control" value="{{ $vehiculo->marca ?? old('marca') }}" required>
</div>

<div class="mb-3">
    <label for="modelo" class="form-label">Modelo</label>
    <input type="text" name="modelo" class="form-control" value="{{ $vehiculo->modelo ?? old('modelo') }}" required>
</div>

<div class="mb-3">
    <label for="anio" class="form-label">Año</label>
    <input type="number" name="anio" class="form-control" value="{{ $vehiculo->anio ?? old('anio') }}" required>
</div>

<div class="mb-3">
    <label for="color" class="form-label">Color</label>
    <input type="text" name="color" class="form-control" value="{{ $vehiculo->color ?? old('color') }}" required>
</div>

<div class="mb-3">
    <label for="placa" class="form-label">Placa</label>
    <input type="text" name="placa" class="form-control" value="{{ $vehiculo->placa ?? old('placa') }}" required>
</div>

<div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select name="estado" class="form-control">
        <option value="disponible" {{ (isset($vehiculo) && $vehiculo->estado=='disponible') ? 'selected' : '' }}>Disponible</option>
        <option value="mantenimiento" {{ (isset($vehiculo) && $vehiculo->estado=='mantenimiento') ? 'selected' : '' }}>No Disponible</option>
    </select>
</div>
