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

function removeTags(str) {
    if ((str===null) || (str===''))
        return false;
    else
        str = str.toString();

    return str.replace( /(<([^>]+)>)/ig, '');
}

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
            if (data[i].diagnosis != null) {
              var data_diagnosis = data[i].diagnosis;
              data_penyakit_raw.push(removeTags(data_diagnosis));
            }
          }

          // kategorikan nama penyaki dari [diare,diare,kejang demam] menjadi [diare,kejang demam]
          myLineChart.data.labels = [];
          $.each(data_penyakit_raw, function(i, el){
            if($.inArray(el, data_penyakit) === -1) {
              data_penyakit.push(el);
              myLineChart.data.labels.push(el);
            }
          });

          myLineChart.data.datasets[0].data = [];
          if (data_penyakit_raw.length == 1) {
            myLineChart.data.datasets[0].data.push(1);
          } else {
            $.each(data_penyakit_raw, function(i, el) {
              var idx = $.inArray(el, data_jumlah_penyakit);
              if(idx === -1) {
                myLineChart.data.datasets[0].data.push(1);
                data_jumlah_penyakit.push(el);
              } else {
                myLineChart.data.datasets[0].data[idx] += 1;
              }
              
            });

            // filter 10 penyakit dengan intensitas terbanyak
            $.each(myLineChart.data.datasets[0].data, function(i, el) {
              var posOfMinVal =  myLineChart.data.datasets[0].data.indexOf(Math.min(...myLineChart.data.datasets[0].data));
              if (myLineChart.data.datasets[0].data.length > 10) {
                myLineChart.data.datasets[0].data.splice(posOfMinVal, 1);
                myLineChart.data.labels.splice(posOfMinVal, 1);
              }
            });
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
  var monthNames = [ "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ];
  $.each(monthNames, function(idx, val) {
    $("ul.dropdown-menu").append('<li><a class="dropdown-item" id="'+ (idx+1) +'">'+ val +'</a></li>');
  });

  $("ul.dropdown-menu li a").click(function(e) {

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
            // sorting data penyakit
            for( var i = 0; i < data.length; i++ ) {
              if (data[i].diagnosis != null) {
                var data_diagnosis = data[i].diagnosis;
                data_penyakit_raw.push(removeTags(data_diagnosis));
              }
            }

            myLineChart.data.labels = [];
            $.each(data_penyakit_raw, function(i, el){
              if($.inArray(el, data_penyakit) === -1) {
                data_penyakit.push(el);
                myLineChart.data.labels.push(el);
              }
            });
            
            myLineChart.data.datasets[0].data = [];
            if (data_penyakit_raw.length == 1) {
              myLineChart.data.datasets[0].data.push(1);
            } else {
              $.each(data_penyakit_raw, function(i, el) {
                var idx = $.inArray(el, data_jumlah_penyakit);
                if(idx === -1) {
                  myLineChart.data.datasets[0].data.push(1);
                  data_jumlah_penyakit.push(el);
                } else {
                  myLineChart.data.datasets[0].data[idx] += 1;
                }
                
              });

              // filter 10 penyakit dengan intensitas terbanyak
              $.each(myLineChart.data.datasets[0].data, function(i, el) {
                var posOfMinVal =  myLineChart.data.datasets[0].data.indexOf(Math.min(...myLineChart.data.datasets[0].data));
                if (myLineChart.data.datasets[0].data.length > 10) {
                  myLineChart.data.datasets[0].data.splice(posOfMinVal, 1);
                  myLineChart.data.labels.splice(posOfMinVal, 1);
                }
              });
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

$("button#print_laporan").click(function() {
  window.print();
});


</script>