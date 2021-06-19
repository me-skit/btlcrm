<hr>

<p><b>Agregar Disciplinas:</b></p>

<form action="#">
  <div class="row">
    <div class="form-group col-sm-7 col-md-7 col-lg-4">
      <label for="discipline-select-{{ $person->id }}">{{ __('Tipo') }}<span class="text-danger">*</span></label>
      <select name="discipline_type" id="discipline-select-{{ $person->id }}" class="form-control selectpicker show-tick" data-id="{{ $person->id }}" required>
        <option value="">Seleccionar tipo...</option>
        <option value="3">Tres meses</option>
        <option value="6">Seis meses</option>
        <option value="0">Tiempo indefinido</option>
      </select>
    </div>

    <div class="form-group col-sm-5 col-md-5 col-lg-3">
      <label for="discipline-start-{{ $person->id }}">{{ __('Inicio') }}<span class="text-danger">*</span></label>
      <input type="date"
        name="start_date"
        id="discipline-start-{{ $person->id }}"
        class="form-control start_date @error('discipline-start-{{ $person->id }}') is-invalid @enderror"
        data-id="{{ $person->id }}"
        value="{{ old('start_date') }}"
        required
      >

      @error('start_date')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group col-sm-5 col-md-5 col-lg-3">
      <label for="discipline-end-{{ $person->id }}">{{ __('Fin') }}</label>
      <input type="date"
        name="end_date"
        id="discipline-end-{{ $person->id }}"
        class="form-control @error('discipline-end-{{ $person->id }}') is-invalid @enderror"
        value="{{ old('end_date') }}"
      >

      @error('end_date')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group col-sm-4 col-md-3 col-lg-2">
      <label for="act-number-{{ $person->id }}">{{ __('No. Acta') }}<span class="text-danger">*</span></label>
      <input type="number" min="1"
        name="act_number"
        id="act-number-{{ $person->id }}"
        class="form-control @error('act-number-{{ $person->id }}') is-invalid @enderror"
        value="{{ old('act_number') }}"
        required
      >

      @error('act_number')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group col-sm-3 col-md-4 col-lg-12 text-right">
      <label for="" class="text-white d-none d-sm-block d-md-block d-lg-none">Boton</label>
      <div>
        <button class="btn btn-success" name="btn-adddiscipline" data-id="{{ $person->id }}">Agregar</button>
      </div>
    </div>
  </div>
</form>