@extends('layouts.master')

@section('content')
	<p class="intro">In order to avoid misunderstandings we have developed this simple online system to confirm requirements and the fees agreed between members of the Fipra Network before any work is done. As a condition of being paid, always fill one in and agree it before you start work with anyone in the Fipra Network</p>

	<div class="buttons">
		<ul class="work-order-menu">
			<li>
                <a href="edt"><i class="fa fa-picture-o fa-4x"></i><p>EDT<br><b style="font-style: italic;">now including Fiptalk</b></p></a>
                <span class="hidejs">The Editorial, Design and Translation Team (EDT) is a group of trained and qualified editors, designers and translators who offer a number of professional editorial, graphic design and translation services to the Fipra Network.<br/><br/>Fiptalk is a team of freelance professional coaches who provide expert training in oral presentation skills.</span>
                <i class="fa fa-info fa-lg info showjs"></i>
            </li>
			<li>
                <a href="unit"><i class="fa fa-sitemap fa-4x"></i><p>Fipra Unit</p></a>
                <span class="hidejs">We call each company or office that has acquired Membership status and also operates under the terms of a Fipra Licence Agreement a "Unit". This IWO can be used for Correspondents and Affiliates too.</span>
                <i class="fa fa-info fa-lg info showjs"></i>
            </li>
			<li>
                <a href="spad"><i class="fa fa-comments fa-4x"></i><p>Fipra Special Adviser</p></a>
                <span class="hidejs">Full members of the Fipra Network who are independent individuals as opposed to companies.</span>
                <i class="fa fa-info fa-lg info showjs"></i>
            </li>
			<li>
                <a href="fiplex"><i class="fa fa-shield fa-4x"></i><p>Fiplex</p></a>
                <span class="hidejs">Fiplex is an "in-house" team of trained and qualified lawyers which offers a professional and experienced legal service to the Fipra Network on an on-demand basis.</span>
                <i class="fa fa-info fa-lg info showjs"></i>
            </li>
		</ul>
	</div>
@stop