<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', $pg_title)
  @section('content')
  {{-- <input type="text" id="CurrentPage" hidden="" value="RLR004">  --}}
  <div class="content p-4">
  	<div class="card" style="width: 165vh;" >
  		<div class="card-header bg-white font-weight-bold">
        <h3> {{$pg_title}} </h3>
      </div>
        @include('employee.reports.license.rptLicenseFilter') 
      <div class="card-body table-responsive">
        
      <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr>
                  <td scope="col" style="text-align: center;">Application Code</td>
                  <td scope="col" style="text-align: center;">Name of the Facilities</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>
                  <td scope="col" style="text-align: center;">Complete Address</td>

                  <td scope="col" style="text-align: center;">Owner and Head of Facility <br/>and Contact Info</td>
                  <td scope="col" style="text-align:center">License Details</td>
                  <td scope="col" style="text-align: center;">Action</td>                 
                  
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                @foreach ($LotsOfDatas as $data)

                    <tr>
                      <td style="text-align:left"><strong>{{$data->appid}}</strong></td>
                      <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                      <td style="text-align:left"><strong>{{( $data->hgpdesc ?? 'NOT FOUND')}}</strong><br/> {{$data->facmdesc}}<br/>{{$data->ocdesc}}<br/>{{$data->classname}} {{$data->subclassname}}</td>
                      <td style="text-align:left">
                        {{$data->street_number}} {{$data->street_name}} {{$data->brgyname}}, {{$data->cmname}},<br/>
                        {{$data->provname}} {{$data->zipcode}} <br/>
                        {{$data->rgn_desc}}
                      </td>
                      
                      <td style="text-align:left">
                        Owned by: <strong>{{$data->owner}}</strong><br/>
                        {{$data->approvingauthority}}, {{$data->approvingauthoritypos}}<br/>
                        Tel: {{$data->landline}}<br/>
                        Fax: {{$data->faxnumber}}<br/>
                        Email: {{$data->email}}
                      </td>

                      <td style="text-align:left">
                        Type: <strong>{{$data->hfser_id}}</strong><br/>
                        License No: <strong>{{$data->licenseNo}}</strong><br/>
                        Issued On: <strong>{{$data->formattedDateApprove}}</strong><br/>
                        Certificate Signatory: {{$data->signatoryname}}<br/>
                        Signatory Position: {{$data->signatorypos}}                    
                      </td>  

                      <td style="text-align:left">
                        <center>
                          @php
                          $link = '';
                          $urlFixed = 
                            url(
                              str_replace(
                              array("{appid}","{hfser_id}"),
                              array($data->appid, $data->hfser_id),
                              $link
                              )
                            );
                          @endphp
                          <a class="btn btn-primary" target="_blank" href="{{ asset('client1/certificates/'.$data->hfser_id.'/'.$data->appid) }}"><i class="fa fa-fw fa-eye"></i></a>
                        </center>
                
                      </td>
                    </tr>

                @endforeach
              @endif 
            </tbody>
          </table>

      </div>
  	</div>
  </div>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
  