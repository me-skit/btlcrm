<div class="row">
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="family_role" class="col-md-5 col-form-label text-md-right">{{ __('Rol familiar') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="family_role" id="edit_family_role" class="form-control">
          <option value="1" {{ $family->pivot->family_role == 1 ? 'selected' : '' }}>Padre o Esposo</option>
          <option value="2" {{ $family->pivot->family_role == 2 ? 'selected' : '' }}>Madre o Esposa</option>
          <option value="3" {{ $family->pivot->family_role == 3 ? 'selected' : '' }}>Hijo</option>
          <option value="4" {{ $family->pivot->family_role == 4 ? 'selected' : '' }}>Hija</option>
        </select>
      </div>
    </div>
  </div>
</div>

<hr>
<!-- * * * * * * * personal info  * * * * * * *-->

@include('families.members.editpersonal')

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

  <div class="col-lg-6 d-none">
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

  <div class="col-lg-6 d-none">
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
      <label for="member" class="col-md-5 col-form-label text-md-right">{{ __('¿Miembro de Bethel?') }}<span class="text-danger">*</span></label>
      <div class="col-md-7">
        <select name="member" id="member" class="form-control attend" required>
          <option value="1" {{ $person->membership->member == 1 ? 'selected' : '' }}>Si</option>
          <option value="0" {{ $person->membership->member ? '' : 'selected' }}>No</option>
          <option value="-1" {{ $person->membership->member == -1 ? 'selected' : '' }}>No, de otra iglesia</option>
        </select>

        @error('member')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="row form-group">
      <label for="campus_id" class="col-md-5 col-form-label text-md-right">{{ __('Sede') }}<span class="text-primary">*</span></label>
      <div class="col-md-7">
        <select name="campus_id" id="campus_id" class="form-control campus" {{ $person->membership->member == 1 ? 'required' : '' }}>
          <option selected value> -- </option>
          @foreach ($campuses as $campus)
            <option value="{{ $campus->id }}" {{ $person->membership->campus_id ? ($person->membership->campus_id == $campus->id ? 'selected' : '') : '' }}>{{ $campus->name }}</option>
          @endforeach
        </select>

        @error('campus_id')
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
      <label for="attend_church" class="col-md-5 col-form-label text-md-right">{{ __('Asiste a la iglesia') }}<span class="text-primary">*</span></label>
      <div class="col-md-7">
        <select name="attend_church" id="attend_church" class="form-control attend">
          <option value="1" {{ $person->membership->attend_church == 1 ? 'selected' : '' }}>Si</option>
          <option value="0" {{ $person->membership->attend_church ? '' : 'selected' }}>No</option>
          <option value="2" {{ $person->membership->attend_church == 2 ? 'selected' : '' }}>Ocasionalmente</option>
          <option value="3" {{ $person->membership->attend_church == 3 ? 'selected' : '' }}>Con problemas físicos para asistir</option>
        </select>

        @error('attend_church')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="row form-group">
      <label for="reason" class="col-md-5 col-form-label text-md-right">{{ __('Motivo') }}</label>
      <div class="col-md-7">
        <input type="text"
          name="reason"
          id="reason"
          class="form-control @error('reason') is-invalid @enderror"
          value="{{ old('reason') ?? $person->membership->reason }}"
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
  <div class="col-lg-6" id="religion-column">
    <div class="row form-group">
      <label for="religion" class="col-md-5 col-form-label text-md-right">{{ __('Religión') }}<span class="text-primary">*</span></label>
      <div class="col-md-7">
        <select name="religion" id="religion" class="form-control">
          <option value="0" {{ $person->religion ? '' : 'selected' }}>Ninguna</option>
          <option value="1" {{ $person->religion == 1 ? 'selected' : '' }}>Evangélico(a)</option>
          <option value="2" {{ $person->religion == 2 ? 'selected' : '' }}>Católico(a)</option>
          <option value="3" {{ $person->religion == 3 ? 'selected' : '' }}>Mormón</option>
          <option value="4" {{ $person->religion == 4 ? 'selected' : '' }}>Adventista</option>
        </select>

        @error('religion')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror         
      </div>    
    </div>
  </div>
</div>

<!-- * * * * * * * preferences  * * * * * * *-->

@include('families.members.editprivileges')
