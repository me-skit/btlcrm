@extends('layouts.app')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  let zoneDistribution = <?php echo json_encode($zone_distribution); ?>;
  google.charts.setOnLoadCallback(() => drawChart('Familias Distribuidas por Zona', 'byzone_chart', zoneDistribution, false));
  let sexDistribution = <?php echo json_encode($sex_distribution); ?>;
  google.charts.setOnLoadCallback(() => drawChart('Distribución Según Sexo', 'bysex_chart', sexDistribution, false, 180));
  let serviceDistribution = <?php echo json_encode($service_distribution); ?>;
  google.charts.setOnLoadCallback(() => drawChart('Distribución por Servicio', 'ocupational_chart', serviceDistribution, true));
  let illnessDistribution = <?php echo json_encode($illness_distribution); ?>;
  google.charts.setOnLoadCallback(() => drawChart('Distribución Según Salud', 'illness_chart', illnessDistribution, true));

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart(title, div_name, distribution, setColors, degree = 0) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows(distribution);

    // Set chart options
    var options = {
      'title': title,
      pieStartAngle: degree
    };

    if (setColors) {
      options.colors = ['#dc3912', '#3366c0'];
    }

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById(div_name));
    chart.draw(data, options);
  }
</script>

<style>
  .chartX {
    width: 100%; 
    min-height: 450px;
  }

  .rowX {
    margin:0 !important;
  }  
</style>

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-2">
      <div class="col-md-10 d-flex justify-content-between align-items-baseline">
        <h3 id="title"><i class="far fa-chart-pie"></i> Estadísticas</h3>
        <div class="d-print-none">
          <a id="btn-print" href="#" class="btn btn-light"><i class="fas fa-print"></i><span class="d-none d-lg-inline"> Imprimir</span></a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card mb-3">
          <div class="card-body">

            <div class="row">
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
                    Total registrados:
                  </div>
                  <div class="col-7 col-sm-8 col-md-9 col-lg-7">
                    <b>
                      {{ $total_members }}
                    </b>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-5 col-sm-4 col-md-3 col-lg-5 border-bottom">
                    No. Familias:
                  </div>
                  <div class="col-7 col-sm-8 col-md-9 col-lg-7">
                    <b>
                      {{ $total_families }}
                    </b>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div id="byzone_chart" class="chart"></div>
              <div id="bysex_chart" class="chart"></div>
              <div id="ocupational_chart" class="chart"></div>
              <div id="illness_chart" class="chart"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

<script>
  function windowsResize() {
    drawChart('Familias Distribuidas por Zona', 'byzone_chart', zone_distribution);
    drawChart('Distribución por Sexo', 'bysex_chart', sex_distribution);
  }

  // window.onresize = windowsResize;
</script>