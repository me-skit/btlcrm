<form action="{{ route('family.update', $family->id) . '?back=' . $back }}" method="POST">
  @csrf
  @method('PATCH')

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel"><span class="font-weight-bold"><i class="fas fa-home"></i> Editar Datos de Familia</span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row form-group">
            <label for="village_id" class="col-md-4 col-form-label text-md-right">{{ __('Ubicación') }}<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <select name="village_id" class="form-control" autofocus>
                  @foreach ($villages as $village)
                    <option value="{{ $village->id }}" {{ $family->village_id == $village->id ? 'selected' : '' }}>{{ $village->name }}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="row form-group">
            <label for="union_type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Unión') }}<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <select name="union_type" class="form-control">
                <option value="1" {{ $family->union_type == 1 ? 'selected' : '' }}>Casados</option>
                <option value="2" {{ $family->union_type == 2 ? 'selected' : '' }}>Unidos</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="family_name" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text"
                name="family_name"
                id="family_name"
                class="form-control @error('family_name') is-invalid @enderror"
                value="{{ old('family_name') ?? $family->family_name }}"
                placeholder="Apellidos"
              >

              @error('family_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text"
                name="address"
                id="address"
                class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address') ?? $family->address }}"
                placeholder="Dirección"
              >

              @error('address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>
            <div class="col-md-6">
              <input type="text"
                name="phone_number"
                id="phone_number"
                class="form-control @error('phone_number') is-invalid @enderror"
                value="{{ old('phone_number') ?? $family->phone_number }}"
                placeholder="Teléfono recidencial"
              >

              @error('phone_nomber')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="row form-group">
            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Long, Lat') }}</label>
            <div class="col-md-6">
              <input type="text"
                name="location"
                id="location"
                class="form-control @error('location') is-invalid @enderror"
                value="{{ old('location') }}"
                placeholder="Longitud, latitud"
              >

              @error('location')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>  
</form>