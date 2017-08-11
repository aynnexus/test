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