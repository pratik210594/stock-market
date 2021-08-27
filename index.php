<?php
$key ="demo";

$url ="https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=RELIANCE.BSE&outputsize=full&apikey=".$key;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result =curl_exec($ch);

curl_close($ch);

$result = json_decode($result,true);
echo '<pre>';
//print_r($result['Time Series (Daily)']['2021-08-23']['1. open']);//
//print_r($result);
//echo $result['2021-08-23'];
$average = array();
$count =0;
$keydate = 26;
$i = 0;
$eightma = 0;
$twentyma = 0;
set_time_limit(1500);
//echo $keydate;
if(isset($result['Time Series (Daily)']))
{
	do					/*Finding 8 MA*/
	{
		
			if(isset($result['Time Series (Daily)']['2021-08-'.$keydate]))
			{
				//	$average[$i] = ($result['Time Series (Daily)']['2021-08-'.$keydate]['1. open'] + $result['Time Series (Daily)']['2021-08-'.$keydate]['2. high'] + $result['Time Series (Daily)']['2021-08-'.$keydate]['3. low'])/3;
					//echo $average[$i]."<br>";
					
					$eightma = $eightma +$result['Time Series (Daily)']['2021-08-'.$keydate]['4. close'];
					$i++;
			}
			
			$keydate = $keydate - 1;
				if($i > 7)
				{
					$eightma = $eightma/8;
					echo " 8MA is ".round($eightma,2) ;
				}
	}while($i<=7);
	$i=0;
	$keydate = 26;
	for ($j = 0; $j <=100; $j++)				/*Finding 20 MA*/
	{
		
			if(isset($result['Time Series (Daily)']['2021-08-'.$keydate]))
			{
				//	$average[$i] = ($result['Time Series (Daily)']['2021-08-'.$keydate]['1. open'] + $result['Time Series (Daily)']['2021-08-'.$keydate]['2. high'] + $result['Time Series (Daily)']['2021-08-'.$keydate]['3. low'])/3;
					//echo $average[$i]."<br>";
					
					$twentyma = $twentyma +$result['Time Series (Daily)']['2021-08-'.$keydate]['4. close'];
					$i++;
					//echo "<br>".$eightma;
					//echo '<br>2021-08-'.$keydate;
			}
			
			$keydate = $keydate - 1;
			if($keydate <10)
			{
				$keydate = str_pad($keydate, 2, '0', STR_PAD_LEFT);
				//echo "hey".$keydate;
			}
				if($i >= 18)
				{
					$twentyma = $twentyma/18;
					echo " <br>20MA is ".round($twentyma,2) ;
					break;
				}
	}
	

}
//phpinfo();
$keydate = 26;
echo "<br>closing of 2021-08-".$keydate." is ".round($result['Time Series (Daily)']['2021-08-'.$keydate]['4. close'],2) ;
if($eightma> $twentyma)
{
	if($eightma< $result['Time Series (Daily)']['2021-08-'.$keydate]['4. close'])
	{
		echo "<br>BUY";
	}
}
else
{
	echo"sell";
}

?>