<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'View Process Flow')
  @section('content')
 {{-- <input type="text" id="CurrentPage" hidden="" value="PF001">  --}}

  <div class="content p-4">
  	<div class="card" >
   
  		<div class="card-header bg-white font-weight-bold">
             <h3>Application Status</h3> 
      </div>
      <form class="filter-options-form">
        @include('employee.tableDataFilter') 
      </form>
      <div class="card-body table-responsive  backoffice-list">
        <div>   
          <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr style="font-weight:bold;">
                  <td scope="col" style="text-align: center;">These are Options</td>
                  <td scope="col" style="text-align: center;">Process / Type</td>
                  <td scope="col" style="text-align: center;">Application Code</td>
                  <td scope="col" style="text-align: center;">Name of the Facility</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>
                  <td scope="col" style="text-align: center;">Applied Date</td>
                  <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                  <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection/ Evaluation</td>
                  <td scope="col" style="text-align: center;">Actual Date of Inspection/ Evaluation </td>
                  <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Client Compliance</td>
                  <td scope="col" style="text-align: center;">Actual Date of Client Compliance</td>
                  <td scope="col" style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Issuance/ Nonissuance</td>
                  <td scope="col" style="text-align: center;">Actual Date of Issuance/ Nonissuance</td>
                  <td scope="col" style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;">Status</td>
                  {{-- <td scope="col" style="text-align:center">Evaluated</td>
                  <td scope="col" style="text-align: center;">Inspected</td>
                  <td scope="col" style="text-align: center;">Approved</td> --}}
                  <td scope="col" style="text-align: center;">Region</td>
                  <td scope="col" style="text-align: center;">Assigned Region Office</td>                 
                  
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                  @if(count($LotsOfDatas) > 0)
                    @foreach ($LotsOfDatas as $data)
                        <tr>
                          <td>
                            <center>
                              <button type="button" title="View detailed information for {{$data->facilityname}}" class="btn btn-info form-control" onclick="showData({{$data->appid}},'{{$data->aptdesc}}', '{{$data->authorizedsignature}}','{{$data->brgyname}}', '{{$data->classname}}' ,'{{$data->cmname}}', '{{$data->email}}', '{{$data->facilityname}}','{{$data->hgpdesc}}', '{{$data->formattedDate}}', '{{$data->formattedTime}}', '{{$data->hfser_desc}}','{{$data->ocdesc}} - {{$data->classname}} - {{$data->subclassname}}', '{{$data->provname}}','{{$data->rgn_desc}}', '{{$data->street_name}}', '{{$data->zipcode}}', '{{$data->isrecommended}}', '{{$data->hfser_id}}', '{{$data->status}}', '{{$data->uid}}', '{{$data->trns_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>
                            </center>
                          </td>
                          <td style="text-align:center">{{$data->aptdesc}} <br/><strong>{{$data->hfser_id}}</strong></td>
                          <td style="text-align:center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                          <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                          <td style="text-align:left">{{( $data->hgpdesc ?? 'NOT FOUND')}} </td>
                          <td style="text-align:left">@if(isset($data->t_date)){{date("F j, Y", strtotime($data->t_date)) }} @else <span style="color:orange;">{{ 'Not Officially Applied Yet' }}</span> @endif </td>
                          <td style="text-align:left">@if(isset($data->CashierApproveformattedDate)){{$data->CashierApproveformattedDate}} @else <span style="color:orange;">{{ 'Not Officially Applied Yet' }}</span> @endif </td>
                          <td style="text-align:left; border-left: darkgray;border-left-width: thin;border-left-style: solid;">@if(isset($data->CashierApproveformattedDate)){{date("F j, Y", strtotime($data->CashierApproveformattedDate. ' + 14 days')) }} @endif </td>
                          <td style="text-align:left">@if(isset($data->formattedInspectedDate)){{$data->formattedInspectedDate}} @endif </td>
                          <td style="text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;">@if(isset($data->CashierApproveformattedDate)){{date("F j, Y", strtotime($data->CashierApproveformattedDate. ' + 44 days')) }} @endif </td>
                          <td style="text-align:left">@if(isset($data->formattedInspectedDate)) {{$data->formattedInspectedDate }} @endif </td>
                          <td style="text-align:left; border-left: darkgray;border-left-width: thin;border-left-style: solid;">@if(isset($data->CashierApproveformattedDate)){{date("F j, Y", strtotime($data->CashierApproveformattedDate. ' + 56 days')) }} @endif </td>
                          <td style="text-align:left">@if(isset($data->formattedApprovedDate)) {{$data->formattedApprovedDate }} @endif </td>
                          <td style="color:black;font-weight:bolder;text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;">{{$data->trns_desc}}<br/>
                              @if(isset($data->submittedReq)) 

                              @else 
                                <span style="color: red">No attachment for basic requirements submitted yet.</span><br/>
                              @endif
                          </td>
                          {{-- <td>
                            <center> 
                              <h5>
                                @if($data->isrecommended == 1) 
                                <span class="badge  badge-success" title="Click for more info" style="cursor:pointer;" data-toggle="modal" data-target="#ShowEvalInfo" onclick="showEvalInfo('{{$data->formattedTimeEval}}', '{{$data->formattedDateEval}}', '{{$data->formattedTimePropEval}}', '{{$data->formattedDatePropEval}}', '{{$data->recommendedbyName}}', '{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}', {{$data->appid}})">Yes</span> 
                                @elseif($data->isrecommended == null) 
                                  <span class="badge badge-warning">Pending</span> 
                                @else 
                                  <span class="badge badge-danger">No</span> 
                                @endif
                              </h5>
                            </center>
                          </td>
                          <td>
                            <center>
                              <h5>
                                @if ($data->isInspected != null)
                                  <span class="badge badge-success">Yes</span>
                                @else 
                                  <span class="badge badge-warning">{{$data->hfser_id == 'CON' ? 'N/A' : 'Pending'}}</span>
                                @endif
                              </h5>
                            </center>
                          </td>
                          <td>
                            <center> 
                              <h5>
                                @if ($data->isApprove == '1')
                                  <span class="badge badge-success">Yes</span>
                                @elseif($data->isApprove == '0')
                                  <span class="badge badge-danger">No</span>
                                @else
                                  <span class="badge badge-warning">Pending</span>
                                @endif
                              </h5>
                            </center>
                          </td>  --}}
                          <td style="text-align:left">{{$data->rgn_desc}}</td>
                          <td style="text-align:left">{{$data->asrgn_desc}}</td>
                        </tr>

                    @endforeach
                  @else
                      <tr><td colspan="16" class="text-center">No data available in table</td></tr>              
                  @endif 
                @else
                  <tr><td colspan="16" class="text-center">No data available in table</td></tr>              
              @endif 
            </tbody>

            <tfoot>
              <tr style="font-weight:bold;">
                  <td scope="col" style="text-align: center;">Options</td>
                  <td scope="col" style="text-align: center;">Process / Type</td>
                  <td scope="col" style="text-align: center;">Code</td>
                  <td scope="col" style="text-align: center;">Name of the Facility</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>
                  <td scope="col" style="text-align: center;">Applied Date</td>
                  <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                  <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection/ Evaluation</td>
                  <td scope="col" style="text-align: center;">Actual Date of Inspection/ Evaluation </td>
                  <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Client Compliance</td>
                  <td scope="col" style="text-align: center;">Actual Date of Client Compliance</td>
                  <td scope="col" style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Issuance/ Nonissuance</td>
                  <td scope="col" style="text-align: center;">Actual Date of Issuance/ Nonissuance</td>
                  <td scope="col" style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;">Status</td>
                  {{-- <td scope="col" style="text-align:center">Evaluated</td>
                  <td scope="col" style="text-align: center;">Inspected</td>
                  <td scope="col" style="text-align: center;">Approved</td> --}}
                  <td scope="col" style="text-align: center;">Region</td>
                  <td scope="col" style="text-align: center;">Assigned Region Office</td>                 
                  
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
  	</div>
  </div>
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog  modal-lg " role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>View Application</strong></h5>
            <hr>
            <div class="container">
                  <form id="ViewNow" data-parsley-validate>
                  <span id="ViewBody">
                  </span>
                  <hr>
                  <div class="row">
                    {{-- <div class="col-sm-6">
                      <button type="button" class="btn btn-info form-control" id="PreAssessButton" style="border-radius:0;"><span class="fa fa-sign-up"></span>View Preassessment</button>
                    </div> --}}
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-info form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
                    </div>
                    <div class="col-sm-3"></div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="modal fade" id="ShowEvalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog {{-- modal-lg --}}" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong><span id="EvalTitle"></span> Evaluation</strong></h5>
            <hr>
            <div class="container">
                  <form id="" data-parsley-validate>
                  <span id="EvalBody">
                  </span>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                    <button type="button" class="btn btn-outline-info form-control" style="border-radius:0;" id="ViewEvalButton"><span class="fa fa-sign-up"></span>View Evaluation</button>
                  </div> 
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                  </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <script type="text/javascript">
    
  	function showData(appid, aptdesc, authorizedsignature, brgyname, classname, cmname, email, facilityname, facname, formattedDate, formattedTime, hfser_desc, ocdesc, provname, rgn_desc, street_name, zipcode, isrecommended, hfser_id, statusX, uid, trns_status){
          var status = '';
          // var paid = appid_payment;
          // if (statusX == 'P') {
          //     status = '<span style="color:orange">Pending</span>';
          // } 
          $('#PreAssessButton').attr('onclick', '');
          $('#PreAssessButton').attr('onclick', "location.href='{{ asset('/employee/dashboard/lps/preassessment') }}/"+uid+"'");
          $('#ViewBody').empty();
          $('#ViewBody').append(
              '<div class="row">'+
                  '<div class="col-sm-4">Facility Name:' +
                  '</div>' +
                  '<div class="col-sm-8">' + facilityname +
                  '</div>' +
              '</div>' +
              // '<br>' + 
              '<div class="row">'+
                  '<div class="col-sm-4">Address:' +
                  '</div>' +
                  '<div class="col-sm-8">' + street_name + ', ' + brgyname + ', ' + cmname + ', ' + provname + ' - ' + zipcode +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Owner:' +
                  '</div>' +
                  '<div class="col-sm-8">' + authorizedsignature + 
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Classification:' +
                  '</div>' +
                  '<div class="col-sm-8">' + ocdesc + 
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Applying for:' +
                  '</div>' +
                  '<div class="col-sm-8">' + hfser_id + ' ('+hfser_desc+') - ' + aptdesc +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Time and Date:' +
                  '</div>' +
                  '<div class="col-sm-8">' + formattedTime + ' - ' + formattedDate +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4"> Client User ID:' +
                  '</div>' +
                  '<div class="col-sm-8">' + uid +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Status:' +
                  '</div>' +
                  '<div class="col-sm-8">' +trns_status +
                  '</div>' +
              '</div>'
            );
      }
      function showEvalInfo(EvalTime, EvalDate, PropTime, PropDate, RecommendedBy/*, RgnRecommended*/, code, idCode){
          $('#ViewEvalButton').attr('onclick','');
          $('#ViewEvalButton').attr('onclick',"location.href='{{ asset('/employee/dashboard/processflow/evaluate') }}/"+idCode+"'");
          $('#EvalTitle').empty();
          $('#EvalTitle').text(code);
          $('#EvalBody').empty();
          $('#EvalBody').append(
                '<div class="row">'+
                    '<div class="col-sm-5">Evaluated On:</div>' +
                    '<div class="cols-sm-7" style="font-weight:bold">' + EvalDate + ' ' + EvalTime +
                    '</div>' + 
                '</div>'  +
                '<div class="row">'+
                    '<div class="col-sm-5">Recommended By:</div>' +
                    '<div class="cols-sm-7" style="font-weight:bold">' + RecommendedBy +
                    '</div>' + 
                '</div>' +
                // '<div class="row">'+
                //     '<div class="col-sm-5">Region Evaluated:</div>' +
                //     '<div class="cols-sm-7" style="font-weight:bold">' + RgnRecommended +
                //     '</div>' + 
                // '</div>' +
                '<div class="row">'+
                    '<div class="col-sm-5">Proposed Inspection:</div>' +
                    '<div class="cols-sm-7" style="font-weight:bold">' + PropDate + ' ' + PropTime +
                    '</div>' + 
                '</div>'
            );
      }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />


<!-- https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js -->