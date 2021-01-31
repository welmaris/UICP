<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>

<script type="text/javascript" src="tableExport/jquery.js"></script>

<script type="text/javascript" src="tableExport/jquery.base64.js"></script>
<script type="text/javascript" src="tableExport/tableExport.js"></script>

<!-- <script type="text/javascript" src="tableExport/html2canvas.js"></script>

<script type="text/javascript" src="tableExport/jspdf/jspdf.js"></script>
<script type="text/javascript" src="tableExport/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="tableExport/jspdf/libs/base64.js"></script> -->

<script type="text/javascript">
$(document).ready(function(e) {

    $("#pdf").click(function(e) {
        $("myTable").tableExport({
            type:'pdf',
            escape: 'true'
        });
    });
});
    </script>

    <body>

        <button id="pdf" > Export as pdf</button>
        
<?php
        $jsonfile = file_get_contents("../data.json");

        //json to array
        $array = json_decode($jsonfile, true);
        
        echo '<table border="1" id="myTable">';
        echo '<tr><th>STN</th><th>PRCP</th></th></tr>';
        
                function sortByPRCP($a, $b) {
                    return $b['PRCP'] <=> $a['PRCP'];
                }
                
                usort($array, 'sortByPRCP');
                //print_r($array);
        
                $newArray = array_slice($array, 0, 5, true);
        
              foreach($newArray as $value) {?>
                <tr>
                  <td><?PHP echo $value["STN"]; ?></td>
                  <td><?PHP echo $value["PRCP"]; ?></td>
                  </tr>
              <?php } echo '</table>'?> 


    </body>
</html>