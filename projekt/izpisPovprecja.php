<?php include_once('glava.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Izpis Povprečja</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.1/chart.min.js"></script>
</head>
<body>
<?php include_once('navbar.php');?>
<table id="izpis" border="1">



</table>

<div class="chart-container" style="position: relative; height:50vh; width:80vw">
    <canvas id="myChart"></canvas>
</div>

<script>

    $(document).ready(function() {
        izpisiPovprecje();
    });

    function izpisiPovprecje(){

        $.get("api.php/baza/povprecje",function(data){


            let $podatki = "<tr><th>Povp. koraki</th><th>Povp. poraba kalorij</th><th>Povp. srčni utrip</th><th>Povp. hitrost</th><th>Povp. razdalja</th><th>Povp. čas</th></tr>";
            $podatki += "<tr><td>"+ data[0].povp_koraki +"</td><td>"+ data[0].povp_poraba_kalorij +"</td><td>"+ data[0].povp_srcni_utrip +"</td><td>"+ data[0].povp_hitrost +"</td><td>"+ data[0].povp_razdalja +"</td><td>"+ data[0].povp_cas +"</td></tr>";
            $("#izpis").html($podatki);

            var min = parseInt(data[0].povp_cas.substring(3,5));
            var hr = parseInt(data[0].povp_cas.substring(0,2));
            while(hr>0){
                min+=60;
                hr--;
            }
            //console.log(min);

            var arr = [data[0].povp_koraki,data[0].povp_poraba_kalorij,data[0].povp_srcni_utrip,data[0].povp_hitrost,data[0].povp_razdalja,min]; //podatki za graf

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Povprečni koraki', 'Povprečna poraba kalorij', 'Povprečni srčni utrip','Povprečna hitrost', 'Povprečna razdalja (m)', 'Povprečni čas (min)'],
                    datasets: [{
                        data: arr,
                        label: 'Podatki',
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {

                    legend: {
                        display: false
                    },

                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        });

    }

</script>
</body>
</html>