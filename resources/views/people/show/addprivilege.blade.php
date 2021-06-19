<hr>

<p><b>Agregar Privilegios:</b></p>

<form action="#" id="form-priv-{{ $person->id }}">
  <div class="row">
    <div class="form-group col-sm-7 col-md-7 col-lg-4">
      <label for="privilege-select-{{ $person->id }}">{{ __('Nombre del privilegio') }}<span class="text-danger">*</span></label>
      <select name="privilege_id" id="privilege-select-{{ $person->id }}" class="form-control selectpicker show-tick" data-live-search="true" required>
        <option value="">Seleccione un privilegio...</option>
        @foreach ($privileges as $privilege)
          <option value="{{ $privilege->id }}">{{ $privilege->description }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-sm-5 col-md-5 col-lg-3">
      <label for="privilege-start-{{ $person->id }}">{{ __('Inicio (opcional)') }}</label>
      <input type="date"
        name="start_date"
        id="privilege-start-{{ $person->id }}"
        class="form-control @error('privilege-start-{{ $person->id }}') is-invalid @enderror"
        value="{{ old('start_date') }}"
      >

      @error('start_date')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group col-sm-5 col-md-5 col-lg-3">
      <label for="privilege-end-{{ $person->id }}">{{ __('Fin (opcional)') }}</label>
      <input type="date"
        name="end_date"
        id="privilege-end-{{ $person->id }}"
        class="form-control @error('privilege-end-{{ $person->id }}') is-invalid @enderror"
        value="{{ old('end_date') }}"
      >

      @error('end_date')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group col-sm-7 col-md-7 col-lg-4">
      <label for="privilege-role-{{ $person->id }}">{{ __('Puesto (opcional)') }}</label>
      <select name="privilege_role_id" id="privilege-role-{{ $person->id }}" class="form-control selectpicker show-tick" data-live-search="true">
        <option value="">Sin puesto</option>
        @foreach ($privilege_roles as $privilege_role)
          <option value="{{ $privilege_role->id }}">{{ $privilege_role->description }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-sm-12 col-md-12 col-lg-8 text-right">
      <label for="" class="text-white d-none d-lg-block d-xl-block">Boton</label>
      <div>
        <button class="btn btn-success" name="btn-addprivilege" data-id="{{ $person->id }}">Agregar</button>
      </div>
    </div>
  </div>
</form>