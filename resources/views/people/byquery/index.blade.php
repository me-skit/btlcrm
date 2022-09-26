@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-2">
      <div class="col-md-12 d-flex justify-content-between align-items-baseline">
        <h3 id="title" data-name="{{ $address }}"><i class="far fa-file-search"></i> Consulta</h3>
        <div class="d-print-none">
          <a id="btn-print" href="#" class="btn btn-light"><i class="fas fa-print"></i><span class="d-none d-lg-inline"> Imprimir</span></a>
        </div>
      </div>
    </div>

    <div class="card d-print-none mb-3">
      <div class="card-body">
        <form action="{{ route('members.queryresult') }}" method="GET">
          <div class="row">
            <div class="col-lg-4">
              <div class="row form-group">
                  <label for="min" class="col-md-5 col-form-label text-md-right">{{ __('Edad mín.') }}<span class="text-danger">*</span></label>
                  <div class="col-md-7">
                    <input type="number"
                      name="min"
                      id="min"
                      class="form-control"
                      min="1" max="150"
                      value="12"
                      required
                      autofocus
                    >
                  </div>
              </div>
            </div>
          
            <div class="col-lg-4">
              <div class="row form-group">
                  <label for="max" class="col-md-5 col-form-label text-md-right">{{ __('Edad máx.') }}<span class="text-danger">*</span></label>
                  <div class="col-md-7">
                    <input type="number"
                      name="max"
                      id="max"
                      class="form-control"
                      min="1" max="150"
                      value="80"
                      required
                    >
                  </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="row form-group">
                <label for="sex" class="col-md-5 col-form-label text-md-right">{{ __('Sexo') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="sex" id="sex" class="form-control" required>
                    <option value="B">Ambos</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <div class="row form-group">
                <label for="status" class="col-md-5 col-form-label text-md-right">{{ __('Estado civil') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="status" id="status" class="form-control" required>
                    <option value="0">Todos</option>
                    <option value="1">Solteros(as)</option>
                    <option value="2">Casados(as)</option>
                    <option value="3">Unidos(as)</option>
                    <option value="4">Divorciados(as)</option>
                    <option value="5">Separados(as)</option>
                    <option value="6">Viudos(as)</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="row form-group">
                  <label for="accepted" class="col-md-5 col-form-label text-md-right">{{ __('Aceptado(a)') }}<span class="text-danger">*</span></label>
                  <div class="col-md-7">
                    <select name="accepted" id="accepted" class="form-control" required>
                      <option value="-1">Ambos</option>
                      <option value="1">Si</option>
                      <option value="0">No</option>
                    </select>
                  </div>      
              </div>
            </div>
          
            <div class="col-lg-4">
              <div class="row form-group">
                <label for="baptized" class="col-md-5 col-form-label text-md-right">{{ __('Bautizado(a)') }}<span class="text-danger">*</span></label>
                <div class="col-md-7">
                  <select name="baptized" id="baptized" class="form-control" required>
                    <option value="-1">Ambos</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 text-right">
              <button type="button" class="btn btn-light mr-1" id="btn-redo"><i class="fas fa-redo"></i><span class="d-none d-lg-inline"> Nueva</span></button>
              <button type="submit" class="btn btn-primary" id="btn-query"><i class="fas fa-search"></i><span class="d-none d-lg-inline"> Buscar</span></button>
            </div>  
          </div>
        </form>
      </div>
    </div>

    <div id="pagination">
    </div>
  </div>
@endsection