@layout('master')
@section('header')
	<h1>A Framework For Web Artisans</h1>
	<br>
		@foreach ($data as $d)
    		<h2>comment is: {{ $d }}.</h2><br>
		@endforeach
		
@endsection

