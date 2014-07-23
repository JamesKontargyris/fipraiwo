@extends('layouts.master')

@section('content')
	<p class="intro">Before payments can be made between members of the Fipra Network, Internal Work Orders (IWO's) are required.</p>

	<div class="buttons">
		<ul class="work-order-menu">
			<li>
                <a href="edt"><i class="fa fa-picture-o fa-4x"></i><p>EDT</p></a>
                <span class="hidejs">The Editorial, Design and Translation Team (EDT) provides professional editorial, graphic design and translation services to the Fipra Network.</span>
                <i class="fa fa-info fa-lg info showjs"></i>
            </li>
			<li>
                <a href="unit"><i class="fa fa-sitemap fa-4x"></i><p>Fipra Unit</p></a>
                <span class="hidejs">Units are all companies who hold a Fipra Licence. Correspondents and Affiliates should also use this IWO.</span>
                <i class="fa fa-info fa-lg info showjs"></i>
            </li>
			<li>
                <a href="spad"><i class="fa fa-comments fa-4x"></i><p>Fipra Special Adviser</p></a>
                <span class="hidejs">Full members of the Fipra Network who are independent individuals as opposed to companies/Units.</span>
                <i class="fa fa-info fa-lg info showjs"></i>
            </li>
			<li>
                <a href="fiplex"><i class="fa fa-shield fa-4x"></i><p>Fiplex</p></a>
                <span class="hidejs">Fiplex is Fipra's "in-house" team of trained lawyers who offer a professional legal service to the Fipra Network on an on-demand basis.</span>
                <i class="fa fa-info fa-lg info showjs"></i>
            </li>
            <li>
                <a href="fiptalk"><i class="fa fa-shield fa-4x"></i><p>Fiptalk</p></a>
                <span class="hidejs">Fiptalk is a team of freelance professional coaches who provide expert training in oral presentation skills.</span>
                <i class="fa fa-info fa-lg info showjs"></i>
            </li>
		</ul>
	</div>
@stop