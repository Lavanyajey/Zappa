<?php
function convertTime($timestamp, $timeZone)
{
	/*
	 * timestamp - timestamp from user machine
	 * timezone - textual representation of user timezone
	 * */
	$userTimeZone = new DateTimeZone($timeZone);
	$serverTimeZone = new DateTimeZone(date_default_timezone_get()); 

	$userTime = new DateTime(date('Y-m-d H:i', $timestamp), $userTimeZone);
	$serverTime = new DateTime(date('Y-m-d H:i', time()), $serverTimeZone);

	$offset = $userTime->getOffset();
	$offset = $offset + $serverTime->getOffset();

	return $timestamp + $offset;
}

function convertTimeA($timestamp, $timeZone)
{
	echo $timeZone ."\n";
	echo date_default_timezone_get() ."\n";

	$userTimeZone = new DateTimeZone($timeZone);
	$serverTimeZone = new DateTimeZone(date_default_timezone_get()); 

	$userTime = new DateTime(date('Y-m-d H:i', $timestamp), $userTimeZone);
	$serverTime = new DateTime(date('Y-m-d H:i', time()), $serverTimeZone);

	$offset = $userTime->getOffset();
	$offset = $offset + $serverTime->getOffset();

	echo $offset . "\n";
	echo date('Y-m-d H:i', $timestamp) . "\n";
	echo date('Y-m-d H:i', $timestamp + $offset) . "\n";
}

 echo date('Y-m-d H:i',convertTime(time(), "Europe/Vilnius")). "\n";
 echo date('Y-m-d H:i',convertTime(time(), "Europe/Oslo")). "\n";
 echo date('Y-m-d H:i',convertTime(time(), "Europe/Berlin")). "\n";
?>
