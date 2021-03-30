<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="family_role" class="col-md-5 col-form-label text-md-right">{{ __('Rol familiar') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="family_role" id="family_role" class="form-control">
          <option value="1" {{ $family->pivot->family_role == 1 ? 'selected' : '' }}>Padre</option>
          <option value="2" {{ $family->pivot->family_role == 2 ? 'selected' : '' }}>Madre</option>
          <option value="3" {{ $family->pivot->family_role == 3 ? 'selected' : '' }}>Hijo</option>
          <option value="4" {{ $family->pivot->family_role == 4 ? 'selected' : '' }}>Hija</option>
        </select>
      </div>
    </div>
  </div>
</div>

<hr>
<!-- * * * * * * * personal info  * * * * * * *-->

@include('people.editpersonal')

<hr>
<!-- * * * * * * * membership section  * * * * * * *-->

<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
        <label for="accepted" class="col-md-5 col-form-label text-md-right">{{ __('Aceptado') }}<span class="text-danger">*</span></label>
        <div class="col-md-7">
          <select name="accepted" class="form-control">
            <option value="1" {{ $person->membership->accepted ? 'selected' : '' }}>Si</option>
            <option value="0" {{ $person->membership->accepted ? '' : 'selected' }}>No</option>
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
            class="form-control @error('date_accepted') is-invalid @enderror"
            value="{{ old('date_accepted') ?? $person->membership->date_accepted }}"
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
          <option value="1" {{ $person->membership->baptized ? 'selected' : '' }}>Si</option>
          <option value="0" {{ $person->membership->baptized ? '' : 'selected' }}>No</option>
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
          class="form-control @error('date_baptized') is-invalid @enderror"
          value="{{ old('date_baptized') ?? $person->membership->date_baptized }}"
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
          <option value="0" {{ $person->membership->discipleship ? '' : 'selected' }}>No</option>
          <option value="1" {{ $person->membership->discipleship ? 'selected' : '' }}>Si</option>
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
          <option value="1" {{ $person->membership->attend_church == 1 ? 'selected' : '' }}>Si</option>
          <option value="0" {{ $person->membership->attend_church ? '' : 'selected' }}>No</option>
          <option value="2" {{ $person->membership->attend_church == 2 ? 'selected' : '' }}>Si, otra iglesia</option>
        </select>
      </div>    
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="campus_id" class="col-md-2 col-form-label text-md-right">{{ __('Cede') }}</label>
      <div class="col-md-10">
        <select name="campus_id" id="campus_id" class="form-control campus" {{ $person->membership->attend_church == 1 ? 'required' : '' }}>
          <option selected value> -- </option>
          @foreach ($campuses as $campus)
            <option value="{{ $campus->id }}" {{ $person->membership->campus_id ? ($person->membership->campus_id == $campus->id ? 'selected' : '') : '' }}>{{ $campus->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>

<hr>
<!-- * * * * * * * preferences  * * * * * * *-->

@include('people.editprivileges')
