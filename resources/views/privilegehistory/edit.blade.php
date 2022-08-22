<div class="row">
  <div class="form-group col-sm-12 col-md-12 col-lg-6">
    <label for="privilege_select_edit">{{ __('Nombre del privilegio') }}<span class="text-danger">*</span></label>
    <select name="privilege_id" id="privilege_select_edit" class="form-control selectpicker show-tick" data-live-search="true" required>
      @foreach ($privileges as $privilege)
        <option value="{{ $privilege->id }}" {{ $privilege->id == $the_privilege->privilege_id ? 'selected' : '' }}>{{ $privilege->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-sm-6 col-md-6 col-lg-3">
    <label for="privilege_start_edit">{{ __('Inicio (opcional)') }}</label>
    <input type="date"
      name="start_date"
      id="privilege_start_edit"
      class="form-control @error('privilege_start_edit') is-invalid @enderror"
      value="{{ old('start_date') ?? $the_privilege->start_date }}"
    >

    @error('start_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-group col-sm-6 col-md-6 col-lg-3">
    <label for="privilege_end_edit">{{ __('Fin (opcional)') }}</label>
    <input type="date"
      name="end_date"
      id="privilege_end_edit"
      class="form-control @error('privilege_end_edit') is-invalid @enderror"
      value="{{ old('end_date') ?? $the_privilege->end_date}}"
    >

    @error('end_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-group col-sm-12 col-md-12 col-lg-6">
    <label for="privilege_role_id_edit">{{ __('Puesto (opcional)') }}</label>
    <select name="privilege_role_id" id="privilege_role_id_edit" class="form-control selectpicker show-tick" data-live-search="true">
      <option value="">Sin puesto</option>
      @foreach ($privilege_roles as $privilege_role)
        <option value="{{ $privilege_role->id }}" {{ $privilege_role->id == $the_privilege->privilege_role_id ? 'selected' : '' }}>{{ $privilege_role->name }}</option>
      @endforeach
    </select>
  </div>
</div>