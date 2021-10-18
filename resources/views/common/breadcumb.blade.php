<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    	@for($i=1; $i <= count(Request::segments()); $i++)
        <li class="breadcrumb-item" {{($i == count(Request::segments()) ? 'active' :'')}}> {{ ucwords(str_replace('-',' ', Request::segment($i))) }}</li>
        @endfor
    </ol>
</nav>