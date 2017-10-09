<?php
use Illuminate\Support\Facades\Storage;
use App\Models\Site;
use App\Models\Lookup;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;

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

function detectOS($userAgent) { 
	
    $os="Unknown";

    $osList=array(
                    '/windows nt 10/i'      =>  'Windows 10',
                    '/windows nt 6.3/i'     =>  'Windows 8.1',
                    '/windows nt 6.2/i'     =>  'Windows 8',
                    '/windows nt 6.1/i'     =>  'Windows 7',
                    '/windows nt 6.0/i'     =>  'Windows Vista',
                    '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                    '/windows nt 5.1/i'     =>  'Windows XP',
                    '/windows xp/i'         =>  'Windows XP',
                    '/windows nt 5.0/i'     =>  'Windows 2k',
                    '/windows me/i'         =>  'Windows ME',
                    '/win98/i'              =>  'Windows 98',
                    '/win95/i'              =>  'Windows 95',
                    '/win16/i'              =>  'Windows 3.11',
                    '/macintosh|mac os x/i' =>  'Mac OS X',
                    '/mac_powerpc/i'        =>  'Mac OS 9',
                    '/linux/i'              =>  'Linux',
                    '/ubuntu/i'             =>  'Ubuntu',
                    '/iphone/i'             =>  'iPhone',
                    '/ipod/i'               =>  'iPod',
                    '/ipad/i'               =>  'iPad',
                    '/android/i'            =>  'Android',
                    '/blackberry/i'         =>  'BlackBerry',
                    '/webos/i'              =>  'Mobile'
                   );

    foreach ($osList as $regex => $value) { 

        if (preg_match($regex, $userAgent)) {
            $os=$value;
        }

    }   

    return $os;

}

function convert_csv($filename,$key,$value,$gend,$age_group)
{	
	$output = fopen('csv/'.$filename, 'w+');
	fputcsv($output, $key); 
	foreach ($value as $row) { 

		$st = Site::find($row['site_id']);
		$gender = ($row['gender']!=null)?$gend[$row['gender']]:'-';
		$age = ($row['age']!=null)?$age_group[$row['age']]:'-';

		$final = array_merge($row,
			[	'Site'=>$st['site_name'],
				'Age'=>$age,
				'Gender'=>$gender,
				'date'=>date('d M Y G:i:s',strtotime($row['created_at']))
			]);
		unset($final['site_id']);unset($final['gender']);
		unset($final['age']);unset($final['created_at']);
		fputcsv($output, $final);	
	}
	fclose($output);

	return $output;
}

function mailSending($guest)
{   
	$cli = Client::active()->get();  
	foreach ($cli as $c) {
		$sit = $c->Allsite($c->site_id);      
		foreach ($sit as $s) { 
			if ($s->site_id==$guest->site_id) {
				$app_user = ['name'=>$c->User->name,'email'=>$c->User->email];
			}
		}
	} 
	
	Mail::send('mail.feedback', ['user' => $guest], function ($message) use ($app_user)
    {                           
    	$message->to($app_user['email'], $app_user['name'])->subject('Feedback Alert');
    });
}

function age_group($age)
{	
	$age_group = Lookup::where('title','Age Group')->where('key',$age)->value('value');
	
	return $age_group;
}

function site_name($id)
{
	return Site::where('site_id',$id)->value('site_name');
}