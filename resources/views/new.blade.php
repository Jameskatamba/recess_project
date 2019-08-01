    <?php
     
    $dataPoints = array( 
        array("label"=>"Product Inquiry", "y"=>8531),
        array("label"=>"Order Configuration", "y"=>4550),
        array("label"=>"Order Booking", "y"=>4503),
        array("label"=>"Invoicing", "y"=>4491),
        array("label"=>"Shipping", "y"=>4400),
        array("label"=>"Delivery", "y"=>4395)
    )
     
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
    <script>
    window.onload = function() {
     
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Order Fulfillment"
        },
        data: [{
            type: "pyramid",
            indexLabel: "{label} - {y}",
            yValueFormatString: "#,##0",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
     
    }
    </script>
    </head>
    <body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
    </html>                              