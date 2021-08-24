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
$keydate = '23';
//echo $keydate;
if(isset($result['Time Series (Daily)']))
{
	for($i=0; $i<=7;$i++)
	{
			$average[$i] = ($result['Time Series (Daily)']['2021-08-'.$keydate]['1. open'] + $result['Time Series (Daily)']['2021-08-'.$keydate]['2. high'] + $result['Time Series (Daily)']['2021-08-'.$keydate]['3. low'])/3;
			echo $average[$i]."<br>";
			$keydate = $keydate - 1;
	}
}
else
{
	echo"Problem";
}

?>