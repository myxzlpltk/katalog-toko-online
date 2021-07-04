<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Data Usaha {{ $business->name }}</title>
</head>
<body>
	<table border="1" cellspacing="0" cellpadding="10" style="width: 100%;">
		<tr>
			<td rowspan="2" align="center">
				<img src="{{ $business->logo_path }}" alt="" width="50">
			</td>
			<td>{{ $business->name }}</td>
			<td rowspan="2">{{ $business->businessType->name }} | {{ $business->businessType->businessField->name }}</td>
		</tr>
		<tr>
			<td>{{ $business->tagline }}</td>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td><b>Direktur</b></td>
						<td>:</td>
						<td>{{ $business->owner->user->name }}</td>
					</tr>
					@if($business->activeMembers->count() > 0)
					<tr>
						<td valign="top"><b>Anggota</b></td>
						<td valign="top">:</td>
						<td>
							@foreach($business->activeMembers as $member)
							<p style="margin: 0">- {{ $member->user->name }}</p>
							@endforeach
						</td>
					</tr>
					@endif
					<tr>
						<td><b>Dosen Pembimbing</b></td>
						<td>:</td>
						<td>{{ $business->teacher->user->name }}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<b>Deskripsi</b><br>
				{!! nl2br(e($business->description)) !!}
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<b>Media Promosi</b><br>
				Instagram : @if($business->instagram) <a href="\\{{ $business->instagram }}">{{ $business->instagram }}</a> @else - @endif<br>
				Facebook  : @if($business->facebook) <a href="\\{{ $business->facebook }}">{{ $business->facebook }}</a> @else - @endif<br>
				Situs Web : @if($business->website) <a href="\\{{ $business->website }}">{{ $business->website }}</a> @else - @endif<br>
			</td>
		</tr>
	</table>

	<h1>Feed Plan</h1>
	<table border="1" cellspacing="0" cellpadding="10" style="width: 100%;">
		<tr>
			<th>Feed Ke-</th>
			<th>Tanggal</th>
			<th>Topik</th>
			<th>Konten</th>
		</tr>

		@foreach($business->feedplans as $feedPlan)
		<tr>
			<td>{{ $feedPlan->feed_index }}</td>
			<td>{{ $feedPlan->plan_date->translatedFormat('j F Y') }}</td>
			<td>{{ $feedPlan->topic }}</td>
			<td>{{ $feedPlan->content }}</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<img src="{{ asset("storage/briefs/{$feedPlan->brief_image}") }}" height="100" alt="">
			</td>
			<td valign="top" colspan="2">
				<p><b>{{ $feedPlan->headline }}</b></p>
				<p>{{ $feedPlan->caption }}</p>
			</td>
		</tr>
		@endforeach
	</table>
</body>
</html>
