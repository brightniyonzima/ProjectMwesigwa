<html>
<head>
    <script src="/js/js/jquery3.2.1.min.js"></script>
    <script src="/js/js/highcharts.js"></script>
    <script src="/js/js/exporting.js"></script>
</head>
<body>
    <!-- <ol>
        <li>
            <a href="/districts_graph" target="_blank">Districts Perfomance</a>
        </li>
    </ol> -->
    <div id="container1" style="width: 550px; height: 400px; margin: 0 auto; margin-top: 80px;"></div>
    <div id="container2" style="width: 550px; height: 400px; margin: 0 auto; margin-top: 80px;"></div>
    <div id="container3" style="width: 550px; height: 400px; margin: 0 auto; margin-top: 80px;"></div>
    <div id="container4" style="width: 550px; height: 400px; margin: 0 auto; margin-top: 80px;"></div>
    <script language="JavaScript">
    $(document).ready(function() {  
        Highcharts.chart('container1', {
          title: {
            text: 'Pneumonia prevalance based on sex'
          },
          subtitle: {
            text: ''
          },
          yAxis: {
            title: {
              text: 'Number of pneumonia cases'
            }
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
          },
          plotOptions: {
            series: {
              label: {
                connectorAllowed: false
              },
              pointStart: 2014
            }
          },
          series: [{
            name: 'Female',
            data: [52, 58, 68]
          }, {
            name: 'Male',
            data: [68, 74, 70]
          }],
          responsive: {
            rules: [{
              condition: {
                maxWidth: 800
              },
              chartOptions: {
                legend: {
                  layout: 'horizontal',
                  align: 'center',
                  verticalAlign: 'bottom'
                }
              }
            }]
          }
        });

        /*comorbidity graph*/
        Highcharts.chart('container2', {
          title: {
            text: 'Pneumonia prevalance based on comorbidity'
          },
          subtitle: {
            text: ''
          },
          yAxis: {
            title: {
              text: 'Number of pneumonia cases'
            }
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
          },
          plotOptions: {
            series: {
              label: {
                connectorAllowed: false
              },
              pointStart: 2014
            }
          },
          series: [{
            name: 'Had other diseases',
            data: [80, 71, 73]
          }, {
            name: 'Did not have',
            data: [40, 61, 65]
          }],
          responsive: {
            rules: [{
              condition: {
                maxWidth: 800
              },
              chartOptions: {
                legend: {
                  layout: 'horizontal',
                  align: 'center',
                  verticalAlign: 'bottom'
                }
              }
            }]
          }
        });  

        /*exclusive breast feeding graph*/
        Highcharts.chart('container3', {
          title: {
            text: 'Pneumonia prevalance based on exclusive breast feeding'
          },
          subtitle: {
            text: ''
          },
          yAxis: {
            title: {
              text: 'Number of pneumonia cases'
            }
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
          },
          plotOptions: {
            series: {
              label: {
                connectorAllowed: false
              },
              pointStart: 2014
            }
          },
          series: [{
            name: 'Still breat feeding',
            data: [48, 59, 90]
          }, {
            name: 'Exclusive breast feeding',
            data: [42, 40, 38]
          }, {
            name: 'Did not breast feed exclusively',
            data: [30, 33, 10]
          }],
          responsive: {
            rules: [{
              condition: {
                maxWidth: 800
              },
              chartOptions: {
                legend: {
                  layout: 'horizontal',
                  align: 'center',
                  verticalAlign: 'bottom'
                }
              }
            }]
          }
        });

        /*birth weight graph*/
        Highcharts.chart('container4', {
          title: {
            text: 'Pneumonia prevalance based on birth weight'
          },
          subtitle: {
            text: ''
          },
          yAxis: {
            title: {
              text: 'Number of pneumonia cases'
            }
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
          },
          plotOptions: {
            series: {
              label: {
                connectorAllowed: false
              },
              pointStart: 2014
            }
          },
          series: [{
            name: 'Under weight',
            data: [73, 81, 88]
          }, {
            name: 'Normal',
            data: [34, 30, 24]
          }, {
            name: 'Over weight',
            data: [13, 21, 26]
          }],
          responsive: {
            rules: [{
              condition: {
                maxWidth: 800
              },
              chartOptions: {
                legend: {
                  layout: 'horizontal',
                  align: 'center',
                  verticalAlign: 'bottom'
                }
              }
            }]
          }
        });
    });
    </script>
</body>
</html>

