<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>

        <script>
        
        $(document).ready(function(){
    $('#btnGetValue').click(function() {
        var selValue = $('input[name=rbnNumber]:checked').val(); 
        
        if(selValue == 'Yes')
        {
             $('p').html('yerp');
        }
        $('p').html('<br/>Selected Radio Button Value is : <b>' + selValue + '</b>');
    });
});
    
    
        function updatePoll() {
            $("#container").html("<img src='img/loading.gif' />");
            
            //Include here the AJAX call
            $.ajax({

                    type: "GET",
                    url: "api/getAnswerAPI.php",
                    dataType: "json",
                    data: { "answer": $(this).attr("answer")},
                    success: function(data,status) {
                       
                    
                    
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    
                    }
                    
                });//ajax
            
            
            //on Success, call the 'updatePollChart' function passing the percentages of the three choices, for example:
            updatePollChart(var1,var2,var3);
        }
        
        //You can change the choice names if different from "yes", "maybe", and "no"
        function updatePollChart(yes, maybe, no) {
            Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: ''
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Choices',
                        colorByPoint: true,
                        data: [{
                            name: 'Yes',
                            y: yes
                        }, {
                            name: 'Maybe',
                            y: maybe,
                            sliced: true,
                            selected: true
                        }, {
                            name: 'No',
                            y: no
                        }]
                    }]
                });
        }//endFunction
        
        </script>
        
    </head>
    <body>

      <h1> Did you see Infinity War? </h1>
      
        <input type="radio" name="rbnNumber" value="Yes" /> Yes<br/>
        <input type="radio" name="rbnNumber" value="Maybe" /> Maybe <br/>
        <input type="radio" name="rbnNumber" value="No" /> No
        <br/><br/>
        <input type="button" onclick="updatePoll()" id="btnGetValue" Value="Submit" />
        <p></p>

      
      
      <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

    </body>
</html>