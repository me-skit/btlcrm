<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="family_role" class="col-md-5 col-form-label text-md-right">{{ __('Rol familiar') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="family_role" id="family_role" class="form-control">
          <option value="1">Padre o Esposo</option>
          <option value="2">Madre o Esposa</option>
          <option value="3">Hijo</option>
          <option value="4">Hija</option>
        </select>
      </div>
    </div>
  </div>
</div>

<hr>
<!-- * * * * * * * personal info  * * * * * * *-->

@include('families.members.createpersonal')

<hr>
<!-- * * * * * * * membership section  * * * * * * *-->

<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
        <label for="accepted" class="col-md-5 col-form-label text-md-right">{{ __('Aceptado') }}<span class="text-danger">*</span></label>
        <div class="col-md-7">
          <select name="accepted" class="form-control">
            <option value="1">Si</option>
            <option value="0">No</option>
          </select>
        </div>      
    </div>
  </div>

  <div class="col-lg-6">
    <div class="row form-group">
        <label for="date_accepted" class="col-md-5 col-form-label text-md-right">{{ __('Fecha aceptó') }}</label>
        <div class="col-md-7">
          <input type="date"
            name="date_accepted"
            id="date_accepted"
            class="form-control @error('date_accepted') is-invalid @enderror"
            value="{{ old('date_accepted') }}"
          >

          @error('date_accepted')
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
      <label for="baptized" class="col-md-5 col-form-label text-md-right">{{ __('Bautizado(a)') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="baptized" class="form-control">
          <option value="1">Si</option>
          <option value="0">No</option>
        </select>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="row form-group">
      <label for="date_baptized" class="col-md-5 col-form-label text-md-right">{{ __('Fecha bautizó') }}</label>
      <div class="col-md-7">
        <input type="date"
          name="date_baptized"
          id="date_baptized"
          class="form-control @error('date_baptized') is-invalid @enderror"
          value="{{ old('date_baptized') }}"
          >

        @error('date_baptized')
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
    <label for="discipleship" class="col-md-5 col-form-label text-md-right">{{ __('Discipulado') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="discipleship" class="form-control">
          <option value="0">No</option>
          <option value="1">Si</option>
        </select>
      </div>
    </div>
  </div>
  
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="attend_church" class="col-md-5 col-form-label text-md-right">{{ __('Asiste a la iglesia') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="attend_church" id="attend_church" class="form-control attend">
          <option value="1">Si</option>
          <option value="0">No</option>
          <option value="2">Ocasionalmente</option>
          <option value="3">Con problemas físicos para asistir</option>
          <option value="-1">Si, otra iglesia</option>
        </select>
      </div>    
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="reason" class="col-md-4 col-lg-2 col-form-label text-md-right">{{ __('Motivo') }}</label>
      <div class="col-md-8 col-lg-10">
        <input type="text"
          name="reason"
          id="reason"
          class="form-control @error('reason') is-invalid @enderror"
          value="{{ old('reason') }}"
          placeholder="Motivo por el que no asiste o asiste poco"
          disabled
        >

        @error('reason')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="row form-group">
      <label for="campus_id" class="col-md-4 col-lg-2 col-form-label text-md-right">{{ __('Sede') }}<span class="text-primary">*</span></label>
      <div class="col-md-8 col-lg-4">
        <select name="campus_id" id="campus_id" class="form-control campus" required>
          <option selected value> -- </option>
          @foreach ($campuses as $campus)
            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>

<!-- * * * * * * * preferences  * * * * * * *-->

@include('families.members.createprivileges')
