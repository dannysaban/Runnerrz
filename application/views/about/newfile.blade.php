@layout('master')
@section ('mycon')
{{ Form::open()}}
{{Form::text('url')}}
{{Form::submit('showURL')}}
<br>
	@foreach ($users as $user)

		{{$user->first_name;}}
     	<br>

	@endforeach
{{ Form::close()}}	
@endsection