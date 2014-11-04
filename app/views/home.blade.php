@extends('layouts.master')

@section('nav_links')
    <li><a class="highlight" href="/admin">SuperUser Login</a></li>
@stop

@section('content')
	@if( ! Session::get('iwo_id'))
		<div class="intro col-8">
	@else
		<div class="intro col-12">
	@endif
			Before payments can be made between members of the Fipra Network, Internal Work Orders (IWOs) are required.
		</div>

	@if( ! Session::get('iwo_id'))
		<div class="col-4 last" align="right">
			<a href="manage" class="secondary block-but"><i class="fa fa-edit"></i> Manage / edit / confirm an existing Internal Work Order</a>
		</div>
    @endif

    @include('manage.partials.messages')

	<div class="buttons col-12">
        @if(Session::get('iwo_id'))
            <div class="message-box">
				<p class="message"><i class="fa fa-warning"></i> <strong>You are currently logged in and managing <em>&quot;{{ Workorder::where('id', Session::get('iwo_id'))->pluck('title') }}&quot;</em> (ref: {{ Session::get('iwo_ref')  }}).</strong><br/><br/>To manage another IWO, you must log out – otherwise you can continue to manage this IWO. If you submit a new IWO you will be logged out.<br>
				<ul class="actions">
				<li><a href="/manage" class="primary"><i class="fa fa-edit"></i> Continue managing this IWO</a></li>
				<li><a href="/manage/logout" class="red-but"><i class="fa fa-times"></i> Logout</a></li>
				</ul>
            </div>
        @endif

		<div class="col-12">
			<h2>Submit a new Internal Work Order</h2>
			<ul class="work-order-menu">
				<li class="col-6">
					<a href="unit" class="highlight"><i class="fa fa-group fa-4x"></i><p>Fipra Unit</p></a>
					<span class="hidejs">Units are all companies who hold a Fipra Licence. Correspondents and Affiliates should also use this IWO.</span>
					<i class="fa fa-info fa-lg info showjs"></i>
				</li>
				<li class="col-6 last">
					<a href="spad/check" class="highlight"><i class="fa fa-sitemap fa-4x"></i><p>Fipra Special Adviser</p></a>
					<span class="hidejs">Full members of the Fipra Network who are independent individuals as opposed to companies/Units.</span>
					<i class="fa fa-info fa-lg info showjs"></i>
				</li>
			</ul>
		</div>
		<div class="col-12">
			<ul class="work-order-menu">
				<li class="col-4">
					<a href="edt"><i class="fa fa-picture-o fa-4x"></i><p>EDT</p></a>
					<span class="hidejs">The Editorial, Design and Translation Team (EDT) provides professional editorial, graphic design and translation services to the Fipra Network.</span>
					<i class="fa fa-info fa-lg info showjs"></i>
				</li>
				<li class="col-4">
					<a href="fiplex"><i class="fa fa-shield fa-4x"></i><p>Fiplex</p></a>
					<span class="hidejs">Fiplex is Fipra's "in-house" team of trained lawyers who offer a professional legal service to the Fipra Network on an on-demand basis.</span>
					<i class="fa fa-info fa-lg info showjs"></i>
				</li>
				<li class="col-4 last">
					<a href="fiptalk"><i class="fa fa-comments fa-4x"></i><p>Fiptalk</p></a>
					<span class="hidejs">Fiptalk is a team of freelance professional coaches who provide expert training in oral presentation skills.</span>
					<i class="fa fa-info fa-lg info showjs"></i>
				</li>

			</ul>
		</div>
	</div>
@stop
	</div>
