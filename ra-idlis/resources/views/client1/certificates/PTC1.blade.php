@extends('main')
@section('content')
@include('client1.cmp.__issuance')
<body>
<?php

function xucwords($string)
{
	$words = split(" ", $string);
	$newString = array();

	foreach ($words as $word)
	{
		if(!preg_match("/^m{0,4}(cm|cd|d?c{0,3})(xc|xl|l?x{0,3})(ix|iv|v?i{0,3})$/", $word)) {
			$word = ucfirst($word);
		} else {
			$word = strtoupper($word);
		}

		array_push($newString, $word);
	}

	return join(" ", $newString);  
}



?>
	<style>
		
		ol{
			padding-left: 2px;list-style: decimal;list-style-type: decimal;
		}
		ol,li{
			list-style: decimal;
			font-family: Cambria, Georgia, serif;
			margin-left: 9px;
		}
		li{
			padding-top: 20px;
    		padding-left: 15px;
		}


		.leftHeader{
			font-family: Cambria, Georgia, serif;
			font-size: 12;
		}
		.rightHeader{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12;
		}
		

		@media print {
			.card-body .row{
				height:26px;
			}

			.card-body {
				line-height: 20px;
			}

			.card-header .row{
				height:100px;
			}

			.card-body .row.location{
				height:50px;
			}
		}

		.watermarked {
			position: relative;
			content: "";
			display: block;
			width: 100%;
			height: 100%;
			top: 0px;
			left: 0px;
			background-image: url("{{asset('ra-idlis/public/img/watermark/watermark.hfsrb.2023.png')}}");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			z-index: 0;
			-webkit-print-color-adjust: exact;
		}
		.watermarked:after {
			
		}
	</style>
	<div class="container mt-5">
		<div class="card">
			<div class="card-header" style="padding-bottom: 5px;">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 100px; padding-left: 20px;">
					</div>
					<!-- <div class="col-md-9"> -->
					<center style="margin-bottom:0;padding-bottom:0; height: 100px;" >
						<h5 class="card-title text-center font-weight-bold" style="margin-bottom:0; margin-top:auto;">Republic of the Philippines</h5>
						<h5 class="card-title text-uppercase text-center font-weight-bold" style="margin:0;">DEPARTMENT OF HEALTH</h5>
						<h3 class="card-title text-uppercase text-center font-weight-bold" style="margin:0;">{{((isset($director->certificateName)) ? $director->certificateName : 'REGION')}}</h3>
					</center>
					<!-- </div> -->
				</div>
			</div>
			<div class="card-body">

				@php 

					$employee_login = session()->get('employee_login');

					if($employee_login) {
						$class = $retTable[0]->assignedRgn == 'hfsrb'? 'watermarked': '';
					} else {
						$class = "";
					}

				@endphp

			
				<div class="{{$class}}" style="font-family: Cambria, Georgia, serif;">
				
					<h1 class="text-center" >PERMIT TO CONSTRUCT</h1>

					<div class="row">
						<div class="col-md-3">
							<span class="leftHeader text-justify" style="float: left; font-family: Cambria, Georgia, serif;" >Owner </span><span style="float: right">:</span>
						</div>
						<div class="col-md-8">
							<span  class="rightHeader text-justify" >{{((isset($retTable[0]->owner)) ? $retTable[0]->owner : 'No owner')}}</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<span class="leftHeader text-justify" style="float: left; font-family: Cambria, Georgia, serif;">Name of Health Facility </span><span style="float: right">:</span>
						</div>
						<div class="col-md-8">
							<span  class="rightHeader text-justify"><strong>{{((isset($retTable[0]->facilityname)) ? strtoupper($retTable[0]->facilityname)  : 'No facility name')}}</strong></span>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-3">
							<span class="leftHeader text-justify" style="float: left; font-family: Cambria, Georgia, serif;">Type of Health Facility </span><span style="float: right">:</span>
						</div>
						<div class="col-md-8">
							<span  class="rightHeader text-justify">{{((isset($retTable[0]->hgpdesc)) ? $retTable[0]->hgpdesc : '')}}  {{((isset($retTable[0]->ocdesc)) ? ' / '.$retTable[0]->ocdesc : '')}} </span>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<span class="leftHeader text-justify" style="float: left; font-family: Cambria, Georgia, serif;">Location </span><span style="float: right">:</span>
						</div>
						<div class="col-md-8">
							<span  class="rightHeader text-justify">
								@php
									$loc =( ($retTable[0]->street_name ? ucwords(strtolower($retTable[0]->street_name)).', ' : ' ') 				 
															.($retTable[0]->street_number ?  ucwords(strtolower($retTable[0]->street_number)).', ' : '' )
															.ucwords(strtolower($retTable[0]->brgyname)).', '.ucwords(strtolower($retTable[0]->cmname)).', '
															.ucwords(strtolower($retTable[0]->provname)).' '.strtoupper($retTable[0]->rgn_desc));

									$stringloc = preg_replace_callback('/\b(?=[LXIVCDM]+\b)([a-z]+)\b/i', function($matches) {   return strtoupper($matches[0]); }, $loc);	
								@endphp

									{{((isset($retTable[0])) ?	$stringloc	: 'No Location.')}}
							</span>
							<!-- <p class="rightHeader"><strong>{{((isset($retTable[0])) ? ($retTable[0]->street_name.', '.$retTable[0]->street_number.', '.$retTable[0]->brgyname.', '.$retTable[0]->cmname.', '.$retTable[0]->provname.' '.$retTable[0]->rgn_desc) : 'No Location.')}}</strong></p> -->
							<!-- <p class="rightHeader"><strong>{{((isset($retTable[0])) ? ($retTable[0]->rgn_desc.', '.$retTable[0]->provname.', '.$retTable[0]->cmname.', '.$retTable[0]->brgyname.', '.$retTable[0]->street_name.' '.$retTable[0]->street_number) : 'No Location.')}}</strong></p> -->
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-3">
							<span style="float: left;" class="leftHeader text-justify">Scope of Work </span><span style="float: right">:</span>
						</div>
						<div class="col-md-8">
							<span  class="rightHeader text-justify"><strong>
							{{((isset($otherDetails->HFERC_comments)) ? $otherDetails->HFERC_comments : 'Not Specified')}}</strong></span>
						</div>
					</div>
					<br/><br/>
					<div style="margin-top:20px;">
						<div class="col-md-12" style="padding:0;">
							<span style="font-size: 12; font-family: Cambria, Georgia, serif;">Terms and Conditions:</span>
							
							<ol type="1" class="text-justify" >
								<li>That the construction, alteration, expansion or renovation of a hospital or other health facility is implemented in accordance with:
									<ol>
										<li>Floor Plans prepared by a duly licensed Architect and/or Civil Engineer and approved by the Health Facilities and Services Regulatory Bureau</li>
										<li>Architectural and engineering drawings (based on approved floor plans by the Regional Office), specifications, building permit and fire safety permit prepared by a duly licensed Architect and/or Civil Engineer and approved by the Office of the Building Official and the Bureau of Fire Protection in the locality;</li>
									</ol>
								</li>
								<li>
									That the permit to construct and approved floor plans comprise observance of appropriate professional practices, prescribed functional relationships and applicable codes;
								</li>
								<li>
									That the permit to construct and approved floor plans are available for ready reference at the construction site;
								</li>
								<li>
									That the permit to construct is considered lapsed and fee paid is forfeited when the work authorized by the permit does not commence within 365 days from date of issuance, or is abandoned during the period specified; in which case, another application shall be filed;
								</li>
								<li>
									That the submission of progress report/status on the construction both for new and existing health facility required every six (6) months until project completion
								</li>
								<li>
									That any addition and/or alteration of scope of work shall be reported immediately to the Health Facilities and Services Regulatory Bureau for appropriate action;
								</li>
								<li>
									That any unauthorized deviation from approved floor plans or any violation of the above condition, will be sufficient ground for the imposition of sanctions as based from the provision of Administrative Order No. 2016-0042
								</li>
								<li>
									Inspection of the facility is necessary prior to the operation, utilization or usage of the approved scope of work.
								</li>
							</ol>

						</div>
					</div>
					<br><br>
					<div class="row">
						<div class="col-md-4" style="vertical-align: bottom;">
												
							<small class="text-small" style="padding-left:12px">PTC No. {{$retTable[0]->licenseNo}}</small><br>
							<small class="text-small" style="padding-left:12px">Date Issued: {{((isset($retTable[0]->approvedDate)) ? date("F j, Y", strtotime($retTable[0]->approvedDate)) : 'No date.')}}</small>
							
							<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
								{{-- <iframe  src="{{asset('ra-idlis/resources/views/client1/qrcode/index.php')}}?data={{asset('client1/certificates/view/external/')}}/{{$retTable[0]->appid}}" style="border: none !important; height: 150px; width: 150px;"></iframe> --}}
								<iframe src="{!!url('qrcode/'.$retTable[0]->appid )!!}" style="border: none !important; height: 230px; width: 260px;"></iframe>
							</p>
						
						</div>
						<div class="col-md-8" style="padding-top:120px;">
							<h3 class="text-uppercase text-center" style="font-size: 30px;"><strong>{{$retTable[0]->signatoryname}}</strong></h3>
							<h4 class="text-small text-center text-muted" style="white-space: pre-line; margin-top:10px;">{{$retTable[0]->signatorypos}}</h4>
						</div>					
					</div>
				</div>
			</div>
			<div class="card-footer">					
				<p class="text-muted text-small">© All Rights Reserved {{((isset($retTable[0]->approvedDate)) ? date("Y", strtotime($retTable[0]->approvedDate)) : 'yyyy.')}}</p>
			</div>
		</div><br>
	</div>
</body>
@endsection