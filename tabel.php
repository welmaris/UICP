
<?php


function arrayToTopFive($data){
echo '<table border="1">';
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
      }


                [415300,'PESHAWAR','PAKISTAN',34.017,71.583,360],
                [415710,'ISLAMABAD AIRPORT','PAKISTAN',33.617,73.1,508],
                [416410,'LAHORE AIRPORT','PAKISTAN',31.517,74.4,217],
                [417490,'NAWABSHAH','PAKISTAN',26.25,68.367,38],
                [417560,'JIWANI','PAKISTAN',25.067,61.8,57],
                [417800,'KARACHI AIRPORT','PAKISTAN',24.9,67.133,22]



<?php
    //Making a table from an aFrray
function arrayToTable($data){
    echo '<table border="1">';
    $isHeaderGenerated = 0;
    foreach($data as $datapunt ){
        if($isHeaderGenerated == 0){
        echo '<tr>';
        foreach(array_keys($datapunt) as $key){ 
          echo "<th>".$key."</th>";
        }
        echo '</tr>';
        $isHeaderGenerated = 1;
      }

      //rows
      echo '<tr>'; 
      foreach($datapunt as $key => $value ){
        echo '<td>'.$value.'</td>';
      }
      echo '</tr>';
    }
  
  echo '</table>';
}

?>