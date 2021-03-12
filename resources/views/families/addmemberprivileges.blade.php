<div class="row text-center">
  <div class="col-md-12 mb-2">
    <h5>Privilegios preferidos</h5>
  </div>
</div>

<div class="row">
  @foreach($privileges as $privilege)
    <div
      class="col-md-6 divcheckbox {{ $privilege->preferred_sex ? ($sexes[$privilege->preferred_sex]) : '' }} {{ $privilege->preferred_status ? ($statuses[$privilege->preferred_status]) : '' }}"
      data-min="{{ $privilege->min_age ? $privilege->min_age : 0 }}"
      data-max="{{ $privilege->max_age ? $privilege->max_age : 0 }}"
      data-id="check-{{ $privilege->id }}"
      >
      <div class="custom-control custom-checkbox">
        <input type="checkbox"
          name="preferences[{{ $privilege->id }}]"
          id="check-{{ $privilege->id }}"
          value="{{ $privilege->description }}"
          class="custom-control-input">
        <label for="check-{{ $privilege->id }}" class="custom-control-label">{{ $privilege->description }}</label>
      </div>
    </div>
  @endforeach
</div>
