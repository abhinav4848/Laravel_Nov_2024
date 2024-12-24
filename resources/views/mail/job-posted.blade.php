<div>
		<h2>{{ $job->title }}</h2>
		<p>Congrats, your job is now live. </p>

		<a href="{{ url('/jobs/' . $job->id) }}">View your Job Listing</a>
</div>
