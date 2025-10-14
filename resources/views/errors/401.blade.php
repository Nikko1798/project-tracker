<style>

    * {
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
}

body {
	text-align: center;
	margin: 0;
	background: linear-gradient(120deg, #2A52BE 0%, #007FFF 100%);
	background-repeat: no-repeat;
	background-attachment: fixed;
	color: #fff;
}

img {
	width: 250px;
	margin: auto;
	padding-top: 3em;
}

h1 {
	font-weight: 200;
	font-size: 4em;
	margin: 1em;
}

p {
	font-size: 1.2em;
}
</style>

<div>
<img src="{{ asset('images/logo.png') }}" style="width:70px; height:auto;" alt="">
	<h1>401 Unauthorized</h1>
	<p>{{ $exception->getMessage() ?: 'Unauthorized access. Please login or check your credentials.' }}</p>
    <a href="{{route('login')}}" style="color: white; "><p>Go back to login page.</p></a>
</div>
