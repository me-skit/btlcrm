<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="first_name" class="col-md-5 col-form-label text-md-right">{{ __('Primer nombre') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <input type="text"
          name="first_name"
          id="first_name"
          class="form-control @error('first_name') is-invalid @enderror"
          value="{{ old('first_name') ?? $person->first_name }}"
          required
          autofocus>

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
          value="{{ old('second_name') ?? $person->second_name }}"
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
          value="{{ old('third_name') ?? $person->third_name }}"
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
          value="{{ old('first_surname') ?? $person->first_surname }}"
          required
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
          value="{{ old('second_surname') ?? $person->second_surname }}"
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
        <select name="sex" class="form-control">
          <option value="M" {{ $person->sex == "M" ? 'selected' : '' }}>Masculino</option>
          <option value="F" {{ $person->sex == 'F' ? 'selected' : '' }}>Femenino</option>
        </select>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="row form-group">
      <label for="status" class="col-md-5 col-form-label text-md-right">{{ __('Estado civil') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="status" class="form-control">
          <option value="1" {{ $person->status == 1 ? 'selected' : '' }}>Casado(a)</option>
          <option value="2" {{ $person->status == 2 ? 'selected' : '' }}>Soltero(a)</option>
          <option value="3" {{ $person->status == 3 ? 'selected' : '' }}>Unido(a)</option>
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
          value="{{ old('birthday') ?? $person->birthday }}"
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

  <div class="col-lg-6">
    <div class="row form-group">
      <label for="death_date" class="col-md-5 col-form-label text-md-right">{{ __('Fecha defunción') }}</label>
      <div class="col-md-7">
        <input type="date"
          name="death_date"
          id="death_date"
          class="form-control @error('death_date') is-invalid @enderror"
          value="{{ old('death_date') ?? $person->death_date }}"
        >

        @error('death_date')
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
      <label for="cellphone" class="col-md-5 col-form-label text-md-right">{{ __('Teléfono Celular') }}</label>
      <div class="col-md-7">
        <input type="text"
          name="cellphone"
          id="cellphone"
          class="form-control @error('cellphone') is-invalid @enderror"
          value="{{ old('cellphone') ?? $person->cellphone }}"
          pattern="[0-9]{8}"
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
          value="{{ old('e_mail') ?? $person->e_mail }}"
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
          value="{{ old('diseases') ?? $person->diseases }}"
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
          value="{{ old('handicaps') ?? $person->handicaps }}"
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
