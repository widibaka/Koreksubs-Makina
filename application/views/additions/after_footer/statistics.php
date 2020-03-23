
<!-- ChartJS -->
<script src="<?= base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    
    //-------------
    //- BAR CHART -
    //-------------
  

    // Get context with jQuery - using jQuery's .get() method.


    var barChartCanvas = $('#barChart').get(0).getContext('2d')

    var barChartData = {
      labels  : [<?php 
        # Printing data from database
        foreach ($stat as $key => $value) {
          echo "'" . $value['bulan'] . " " . $value['tahun'] . "',";
        }

        ?>],
      datasets: [
        {
          label               : 'Views',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php 
            
        # Printing data from database
        foreach ($stat as $key => $value) {
          echo "'" . $value['view_count'] . "',";
        }

        ?>]
        },
        {
          label               : 'Downloads',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php 
            
        # Printing data from database
        foreach ($stat as $key => $value) {
          echo "'" . $value['download_count'] . "',";
        }

        ?>]
        },
      ]
    }



    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })



    
  })
</script>