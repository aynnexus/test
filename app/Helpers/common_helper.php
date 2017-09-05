<?php
use Illuminate\Support\Facades\Storage;

function showPrettyStatus($status){
	if($status == ACTIVE) echo "<p onclick='getStatus(1);' class='btn btn-success btn-xs'>Enabled</p>";
	else echo "<p onclick='getStatus(0);' class='btn btn-danger btn-xs'>Disabled</p>";
}

function normal_step($number)
{	
	$data = 0;
	switch ($number) {
		case '1':
			$data = 'step_one';
			break;
		case '2':
			$data = 'step_two';
			break;
		case '3':
			$data = 'step_three';
			break;
		
		default:break;
	}
	return $data;
}

function next_step($string)
{	
	$data = 0;
	switch ($string) {
		case 'step_one':
			$data = 'step_two';
			break;
		case 'step_two':
			$data = 'step_three';
			break;
		case 'step_three':
			$data = 'step_four';
			break;
		
		default:break;
	}
	return $data;
}

function fileUpload($file,$name)
{
	$extension = $file->getClientOriginalExtension();
	$path = $name.'/'.date('Y').'/'.date('m').'/';
	$name = $name.time().'.'.$extension;
	if(Storage::disk('public')->put($path.'/'.$name,  File::get($file))){
        $result['file_path'] = $path;
        $result['file_name'] = $name;
    }
	return $result;
}

function authorizeGuest()
{
	echo 'hi';
}

function datetime_convert($timestamp,$second)
{	
	$minute = $second*60;
	$format = strtotime($timestamp) + $minute;
	$result = date('Y-m-d H:i:s', $format);

	return $result;
}

function avgAge($age)
{	
	$type_1 = [13,14,15,16,17];
	$type_2 = [18,19,20,21,22,23,24];
	$type_3 = [25,26,27,28,29,30,31,32,33,34];
	$type_4=  [35,36,37,38,39,40,41,42,43,44];
	$type_5 = [45,46,47,48,49,50,51,52,53,54];
	$type_6 = [55,56,57,58,59,60,61,62,63,64];
	$type_7 = [65,66,67,68,69,70];
	switch ($age) {
		case in_array($age, $type_1):
			$result = 1;
			break;
		case in_array($age, $type_2):
			$result = 2;
			break;
		case in_array($age, $type_3):
			$result = 3;
			break;
		case in_array($age, $type_4):
			$result = 4;
			break;
		case in_array($age, $type_5):
			$result = 5;
			break;
		case in_array($age, $type_6):
			$result = 6;
			break;
		case in_array($age, $type_7):
			$result = 7;
			break;
		
		default:break;
	}
	return $result;
}