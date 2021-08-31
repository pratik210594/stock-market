<?php
$key ="VM61E6KNAMH48NQJ";

$url ="https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=RELIANCE.BSE&outputsize=full&apikey=".$key;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result =curl_exec($ch);

curl_close($ch);

$result = json_decode($result,true);
echo '<pre>';
//print_r($result['Time Series (Daily)']['2021-08-09']['1. open']);//
//print_r($result);
//echo $result['2021-08-23'];
$average = array();
$count =0;
$keydate = 27;
$keymonth = '08';
$keyyear = 2021;
$i = 0;
$eightma = 0;
$twentyma = 0;
//set_time_limit(500);
//echo $keydate;
if(isset($result['Time Series (Daily)']))
{
	for ($j = 0; $j <=500; $j++)				/*Finding 20 MA*/
	{
		//	echo '<br>2021-'.$keymonth.'-'.$keydate;
		
			if(isset($result['Time Series (Daily)'][$keyyear."-".$keymonth."-".$keydate]))
			{
				//	$average[$i] = ($result['Time Series (Daily)']['2021-08-'.$keydate]['1. open'] + $result['Time Series (Daily)']['2021-08-'.$keydate]['2. high'] + $result['Time Series (Daily)']['2021-08-'.$keydate]['3. low'])/3;
					//echo $average[$i]."<br>";
					
					$twentyma = $twentyma +$result['Time Series (Daily)'][$keyyear."-".$keymonth."-".$keydate]['4. close'];
					$i++;
					//echo "<br>".$i;
					//echo "<br>".$eightma;
					//echo "<br>".$keyyear."-".$keymonth."-".$keydate;
					//echo $keymonth." ".$keydate;
			}
			
			$keydate = $keydate - 1;
			if($keydate == 1)
			{
				if($keymonth == 1 && $keydate == 1)
				{
					$keymonth = 12;
					$keyyear = $keyyear -1;
				//	echo "<br>Important ".$keymonth." ".$keyyear;
						$keydate =31;
				//		echo "<br>Important ".$keyyear."-".$keymonth."-".$keydate;;
				
					//echo $keyyear;
					
					
				}
				else{	
					$keymonth = $keymonth -1;
					$keymonth = str_pad($keymonth, 2, '0', STR_PAD_LEFT);
					$keydate =31;
				}
				
			}
			
			
			if($keydate <10)
			{
				$keydate = str_pad($keydate, 2, '0', STR_PAD_LEFT);
				//echo "hey".$keydate;
			}
				if($i >= 199)
				{
					$twentyma = $twentyma/200;
					echo " 200MA is ".round($twentyma,2) ;
					break;
				}
	}
	

}
//phpinfo();
//echo "<br>out of loop".$i;
$keydate = 27;
echo "<br>closing is ".$result['Time Series (Daily)']['2021-08-'.$keydate]['4. close'] ;
//echo "<br> ".$twentyma;
if($twentyma< $result['Time Series (Daily)']['2021-08-'.$keydate]['4. close'])
{
	echo "<br>BUY";
}
else
{
	//echo"<br>Problem";
}
//phpinfo();
?>