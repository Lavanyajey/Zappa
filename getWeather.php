<html>
<body>
<?php

function FtoC($fah) {
  return round(($fah - 32)*5/9);
}
function getWeather($postCode) {

$requestAddress = "http://www.google.com/ig/api?weather=".$postCode;

$xml_str = file_get_contents($requestAddress,0);

$xml = new SimplexmlElement($xml_str);
    
    foreach($xml->weather as $item) {
        $location = $item->forecast_information->city['data'];
        if(isset($location)) {
          $today = array(
            'condition' => $item->current_conditions->condition['data'],
            'temp' => FtoC($item->current_conditions->temp_f['data']),
            'humidity' => $item->current_conditions->humidity['data'],
            'wind' => $item->current_conditions->wind_condition['data'],
            'date' => $item->forecast_information->forecast_date['data'],
            'icon' => $item->current_conditions->icon['data'],
          );
          $count = 0;
          $future = array();
          foreach($item->forecast_conditions as $new) {
              $future[$count] = array(
                'dayOfWeek' => $new->day_of_week['data'],
                'lowTemp' => FtoC($new->low['data']),
                'highTemp' => FtoC($new->high['data']),
                'condition' => $new->condition['data'],
                'icon' => $new->icon['data'],
              );
              $count++;
              
          }
        }
    }
return array($location, $today, $future);
}

$val = getWeather($_GET['pc']);
$location = $val['0'];
$today = $val['1'];
if(isset($location)) {
  echo '<img src="http://www.google.com/' . $today['icon'] . '"><br/>';
  echo 'Today in '. $location .' the weather condition is: '. $today['condition'].' with temperatures around '.$today['temp'].' degrees Celsius.';
}  
else
  echo 'That post code or town isn\'t valid try, for instance, EH16 or London';

?>

</body>
</html>