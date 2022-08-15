<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="first_name" class="col-md-5 col-form-label text-md-right">{{ __('Primer nombre') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <input type="text"
          name="first_name"
          id="first_name"
          class="form-control @error('first_name') is-invalid @enderror"
          value="{{ old('first_name') }}"
          required
          placeholder="Primer nombre"
          >

        @error('first_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="row form-group">
      <label for="second_name" class="col-md-5 col-form-label text-md-right">{{ __('Segundo nombre') }}</label>
      <div class="col-md-7">
        <input type="text"
          name="second_name"
          id="second_name"
          class="form-control @error('second_name') is-invalid @enderror"
          value="{{ old('second_name') }}"
          placeholder="Segundo nombre"
        >

        @error('second_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="third_name" class="col-md-5 col-form-label text-md-right">{{ __('Tercer nombre') }}</label>
      <div class="col-md-7">
        <input type="text"
          name="third_name"
          id="third_name"
          class="form-control @error('third_name') is-invalid @enderror"
          value="{{ old('third_name') }}"
          placeholder="Tercer nombre"
        >

        @error('third_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="first_surname" class="col-md-5 col-form-label text-md-right">{{ __('Primer apellido') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <input type="text"
          name="first_surname"
          id="first_surname"
          class="form-control @error('first_surname') is-invalid @enderror"
          value="{{ old('first_surname') }}"
          required
          placeholder="Primer apellido"
        >

        @error('first_surname')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>  
  </div>

  <div class="col-lg-6">
    <div class="row form-group">
      <label for="second_surname" class="col-md-5 col-form-label text-md-right">{{ __('Segundo apellido') }}</label>
      <div class="col-md-7">
        <input type="text"
          name="second_surname"
          id="second_surname"
          class="form-control @error('second_surname') is-invalid @enderror"
          value="{{ old('second_surname') }}"
          placeholder="Segundo apellido"
        >

        @error('second_surname')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="sex" class="col-md-5 col-form-label text-md-right">{{ __('Sexo') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="sex" id="sex" class="form-control">
          <option value="M">Masculino</option>
          <option value="F">Femenino</option>
        </select>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="row form-group">
      <label for="status" class="col-md-5 col-form-label text-md-right">{{ __('Estado civil') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="status" id="status" class="form-control" required>
          <option value selected>Seleccionar...</option>
          <option value="1">Casado(a)</option>
          <option value="2">Soltero(a)</option>
          <option value="3">Unido(a)</option>
          <option value="4">Divorciado(a)</option>
          <option value="6">Viudo(a)</option>
        </select>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="birthday" class="col-md-5 col-form-label text-md-right">{{ __('Fecha nacimiento') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <input type="date"
          name="birthday"
          id="birthday"
          class="form-control @error('birthday') is-invalid @enderror"
          value="{{ old('birthday') }}"
          required
        >

        @error('birthday')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="cellphone" class="col-md-5 col-form-label text-md-right">{{ __('Teléfono celular') }}</label>
      <div class="col-md-7">
        <input type="text"
          name="cellphone"
          id="cellphone"
          class="form-control @error('cellphone') is-invalid @enderror"
          value="{{ old('cellphone') }}"
          pattern="[0-9]{8}(,\s*[0-9]{8})*"
          title="Números de teléfono de 8 digitos, separados por coma"
          placeholder="Número(s) personal(es)"
        >

        @error('cellphone')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="e_mail" class="col-md-5 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>
      <div class="col-md-7">
        <input type="email"
          name="e_mail"
          id="e_mail"
          class="form-control @error('e_mail') is-invalid @enderror"
          value="{{ old('e_mail') }}"
          pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$"
          title="nombre de usuario, seguido de @ y un dominio valido"
          placeholder="Correo electrónico"
        >

        @error('e_mail')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="diseases" class="col-md-5 col-form-label text-md-right">{{ __('Enfermedades') }}</label>
      <div class="col-md-7">
        <input type="text"
          name="diseases"
          id="diseases"
          class="form-control @error('diseases') is-invalid @enderror"
          value="{{ old('diseases') }}"
          data-role="tagsinput"
          placeholder="Separadas por comas"
        >

        @error('diseases')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="row form-group">
      <label for="handicaps" class="col-md-5 col-form-label text-md-right">{{ __('Discapacidades') }}</label>
      <div class="col-md-7">
        <input type="text"
          name="handicaps"
          id="handicaps"
          class="form-control @error('handicaps') is-invalid @enderror"
          value="{{ old('handicaps') }}"
          data-role="tagsinput"
          placeholder="Separadas por comas"
        >

        @error('handicaps')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
</div>
