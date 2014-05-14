@extends('layouts.master')

@section('content')
	<p class="intro">Select the Internal Work Order form you require:</p>

	<div class="buttons">
		<ul class="work-order-menu">
			<li><a href="edt"><i class="fa fa-picture-o fa-4x"></i><p>Editorial, Design and Translation Team (EDT)</p></a></li>
			<li><a href="unit"><i class="fa fa-sitemap fa-4x"></i><p>Units / Correspondents / Affiliates</p></a></li>
			<li><a href="spad"><i class="fa fa-comments fa-4x"></i><p>Special Advisers</p></a></li>
			<li><a href="fiplex"><i class="fa fa-shield fa-4x"></i><p>Fiplex</p></a></li>
		</ul>
	</div>
@stop