<div class="row" id="edit-discipline" data-id="{{ $discipline->id }}">
  <div class="form-group col-sm-7 col-md-7 col-lg-4">
    <label for="discipline_select_edit">{{ __('Tipo') }}<span class="text-danger">*</span></label>
    <select name="discipline_select_edit" id="discipline_select_edit" class="form-control selectpicker show-tick" required>
      <option value="3" {{ $discipline->discipline_type == 3 ? 'selected' : '' }}>Tres meses</option>
      <option value="6" {{ $discipline->discipline_type == 6 ? 'selected' : '' }}>Seis meses</option>
      <option value="0" {{ $discipline->discipline_type ? '' : 'selected' }}>Tiempo indefinido</option>
    </select>
  </div>

  <div class="form-group col-sm-5 col-md-5 col-lg-3">
    <label for="discipline_start_edit">{{ __('Inicio') }}<span class="text-danger">*</span></label>
    <input type="date"
      name="discipline_start_edit"
      id="discipline_start_edit"
      class="form-control @error('discipline_start_edit') is-invalid @enderror"
      value="{{ old('discipline_start_edit') ?? $discipline->start_date }}"
      required
    >

    @error('discipline_start_edit')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-group col-sm-5 col-md-5 col-lg-3">
    <label for="discipline_end_edit">{{ __('Fin') }}</label>
    <input type="date"
      name="discipline_end_edit"
      id="discipline_end_edit"
      class="form-control @error('discipline_end_edit') is-invalid @enderror"
      value="{{ old('discipline_end_edit') ?? $discipline->end_date }}"
    >

    @error('discipline_end_edit')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-group col-sm-4 col-md-3 col-lg-2">
    <label for="act_number_edit">{{ __('No. Acta') }}<span class="text-danger">*</span></label>
    <input type="number" min="1"
      name="act_number_edit"
      id="act_number_edit"
      class="form-control @error('act_number_edit') is-invalid @enderror"
      value="{{ old('act_number_edit') ?? $discipline->act_number }}"
      required
    >

    @error('act_number_edit')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>