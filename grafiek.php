<!DOCTYPE HTML>
    <html>
    <head>
    <script>
    window.onload = function() {
     
    var dataPoints = [];
     
    var chart = new CanvasJS.Chart("chartContainer", {
    	animationEnabled: true,
    	theme: "light2",
    	zoomEnabled: true,
    	title: {
    		text: "Bitcoin Price - 2017"
    	},
    	axisY: {
    		title: "Price in USD",
    		titleFontSize: 24,
    		prefix: "$"
    	},
    	data: [{
    		type: "line",
    		yValueFormatString: "$#,##0.00",
    		dataPoints: dataPoints
    	}]
    });
     
    function addData(data) {
    	var dps = data.price_usd;
    	for (var i = 0; i < dps.length; i++) {
    		dataPoints.push({
    			x: new Date(dps[i][0]),
    			y: dps[i][1]
    		});
    	}
    	chart.render();
    }
     
    $.getJSON("https://canvasjs.com/data/gallery/php/bitcoin-price.json", addData);
     
    }
    </script>
    </head>
    </html>                              