<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [],
    datasets: [{
      label: "Kasus",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          callback: function(value, index, values) {
            return number_format(value) + ' kasus';
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});

function getDiagnosis() {
  var data_penyakit = [];
  var data_penyakit_raw = [];
  var data_jumlah_penyakit = [];
  $.ajax({
      url: "<?= base_url('laporan/read_diagnosis'); ?>",
      success: function(result) {
        var data = JSON.parse(result);

        if (data.length > 0) {
          const d = new Date();
          let cur_month = d.getMonth() + 1;

          // sesuaikan dengan bulan
          for( var i = 0; i < data.length; i++ ) {
            console.log();
            if (data[i].diagnosis != null) {
              var data_month = data[i].tgl.split("/")[1];
              if (data_month == cur_month) {
                  var data_diagnosis = data[i].diagnosis;
                  data_penyakit_raw.push(data_diagnosis);
              }
            }
          }
          console.log(data_penyakit_raw);

          // kategorikan nama penyaki dari [diare,diare,kejang demam] menjadi [diare,kejang demam]
          myLineChart.data.labels = [];
          $.each(data_penyakit_raw, function(i, el){
            if($.inArray(el, data_penyakit) === -1) {
                if (data_penyakit.length < 10) {
                  data_penyakit.push(el);
                  myLineChart.data.labels.push(el);
                }
            }
          });

          myLineChart.data.datasets[0].data = [];
          var jumlah = 1;
          var cur_data = data_penyakit_raw[0];
          for (var i = 1; i < data_penyakit_raw.length; i++) {
            if (cur_data != data_penyakit_raw[i]) {
              myLineChart.data.datasets[0].data.push(jumlah);
              jumlah = 1;
            } else {
              jumlah++;
            }

            if (data_penyakit_raw[i+1] == undefined) {
              myLineChart.data.datasets[0].data.push(jumlah);
              jumlah = 1;
            }
            cur_data = data_penyakit_raw[i];
          }
        } else {
          myLineChart.data.labels = ["Tidak ada Kasus", "Tidak ada Kasus"];
            myLineChart.data.datasets[0].data = [0, 0];
        }

      },
  }).done(function() {
    myLineChart.update();
  });
}
getDiagnosis();

$("a.dropdown-toggle").click(function(e) {

  e.preventDefault();
  $("ul.dropdown-menu").empty();
  var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
  $.each(monthNames, function(idx, val) {
    $("ul.dropdown-menu").append('<li><a class="dropdown-item" id="'+ (idx+1) +'">'+ val +'</a></li>');
  });

  $("ul.dropdown-menu li a").click(function(e) {
    console.log($(this).text());

    $("h1#page_title").text("Laporan " + $(this).text());

    var data_penyakit = [];
    var data_penyakit_raw = [];
    var data_jumlah_penyakit = [];

    $.ajax({
        url: "<?= base_url('laporan/read_diagnosis_by_month'); ?>",
        data: {
          month_filter: $(e.currentTarget).attr("id"),
        },
        method: "POST",
        success: function(result) {
          var data = JSON.parse(result);

          if ( data.length > 0 ) {
            console.log(data);
            // sorting data penyakit
            for( var i = 0; i < data.length; i++ ) {
              data_penyakit_raw.push(data[i].diagnosis);
            }

            myLineChart.data.labels = [];
            $.each(data_penyakit_raw, function(i, el){
              if($.inArray(el, data_penyakit) === -1) {
                  if (data_penyakit.length < 10) {
                    data_penyakit.push(el);
                    myLineChart.data.labels.push(el);
                  }
              }
            });
            
            // arraynya data_jumlah_penyakit
            myLineChart.data.datasets[0].data = [];
            var jumlah = 1;
            var cur_data = data_penyakit_raw[0];
            for (var i = 1; i < data_penyakit_raw.length; i++) {
              if (cur_data != data_penyakit_raw[i]) {
                myLineChart.data.datasets[0].data.push(jumlah);
                jumlah = 1;
              } else {
                jumlah++;
              }

              if (data_penyakit_raw[i+1] == undefined) {
                myLineChart.data.datasets[0].data.push(jumlah);
                jumlah = 1;
              }
              cur_data = data_penyakit_raw[i];
            } 
          } else {
            myLineChart.data.labels = ["Tidak ada Kasus", "Tidak ada Kasus"];
            myLineChart.data.datasets[0].data = [0, 0];
          }

        },

    }).done(function() {
      myLineChart.update();
    });
  });
});

// $("button#print_laporan").click(function() {
//   $("div.chart-area").;
// });


</script>