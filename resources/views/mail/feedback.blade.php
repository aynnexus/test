<!DOCTYPE html>
<html>
<head>
	<title>Feedback</title>
</head>
<body>
<h3>This is user feed back</h3>
<table>
	<h4>Site Name - {{site_name($user['site_id'])}}</h4>
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Facebook ID</th>
			<th>Gender</th>
			<th>Age Group</th>
			@foreach(json_decode($user['rating_key']) as $value)
				<th>{{$value}}</th>
			@endforeach
			<th>Feedback</th>
			<th>Submited</th>
		</tr>
		<tr>
			<td>{{$user['name']}}</td>
			<td>{{$user['email']}}</td>
			<td>{{$user['social_id']}}</td>
			<td>
				@if($user['gender']==1)
					Male
				@else
					Female
				@endif
			</td>
			<td>{{age_group($user['age'])}}</td>
			@foreach(json_decode($user['rating_value']) as $value)
				<th>{{$value}}</th>
			@endforeach
			
			<td>{{$user['comment']}}</td>
			<td>{{date('d M, Y G:i:s',strtotime($user['created_at']))}}</td>
		</tr>
	</table>
</table>
</body>
</html>