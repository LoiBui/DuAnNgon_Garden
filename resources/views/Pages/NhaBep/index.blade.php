@extends('Layout.index')

@section('content')
<div id="obj">
	<div>@{{message}}</div>
</div>


@endsection
@section('script')
<script>
	new Vue({
	el: "#obj",
	data:{
		message: "this is data of vuejs"
	}

})
</script>
@endsection