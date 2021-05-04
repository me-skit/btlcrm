@extends('layouts.app')

@section('content')
  <div class="container" id="disciplines-list">
    @include('disciplinehistory.list')
  </div>

  <!-- confirm finish discipline modal -->
  <form action="#">
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel"><b><i class="far fa-exclamation-triangle"></i> Finalizar Disciplina</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            Dar por finalizada la disciplina evitará que vuelva a aparecer en este listado. ¿Desea dar por finalizada la disciplina?

            <div class="row py-2">
              <div class="col-lg-12">
                <div class="row form-group">
                  <label for="discipline_end" class="col-md-5 col-form-label text-md-right">{{ __('Fecha de finalización') }}<span class="text-danger">*</span></label>
                  <div class="col-md-7">
                    <input type="date"
                      name="discipline_end"
                      id="new-end-date"
                      class="form-control @error('discipline_end') is-invalid @enderror"
                      value="{{ old('discipline_end') }}"
                      max="{{ date('Y-m-d') }}"
                      required
                    >
            
                    @error('discipline_end')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>          

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger" id="end-discipline">Finalizar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection