@layout('master')
@section('header')


<br>
	@foreach ($users as $user)

		{{$user['title'];}}
		{{$user['author'];}}
		<br>
		

	@endforeach	
@endsection