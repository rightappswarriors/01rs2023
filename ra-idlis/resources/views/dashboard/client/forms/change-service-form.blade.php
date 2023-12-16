@php 
    $main_serv_desc = "Main Services"; 
    $addon_serv_desc = "Add On Services";
@endphp
<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="text-uppercase font-weight-bold">List of {{$main_serv_desc}}</h3>
    </div>
    @php
        $_aptid = $aptid;
        $_aptdesc = "Change Request";
        $_dispSubmit = true;
        $_dispData = "Update Details";
    @endphp      
    <div class="col-md-12">  
        <form id="mainForm">
            {{csrf_field()}}
            <input type="hidden" name="uid" id="uid" value="{{isset($user->uid) ? $user->uid : '' }}"/>
            <input type="hidden" name="appid" id="appid" />              
            <div class="row">
                <div class="text-center">
                    <a class="btn btn-success action-btn" href="#" title="Add New Assessment Part" data-toggle="modal" data-target="#mainService">
                        <i class="fa fa-plus-circle"></i>&nbsp;Add new
                    </a>
                </div>
            </div>
            <table class="table display" id="example" style="overflow-x: scroll;">
                <thead>
                    <tr>
                        <th class="text-center" style="width:  auto">Description</th>
                        <th class="text-center" style="width:  auto">
                            <center>Options</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data))
                    @foreach ($data as $d)
                        <tr>
                            <td class="text-center">{{$d->hgpdesc}}</td>
                            <td class="text-center"><button class="btn-primarys" onclick="showData(
                                '{{$d->facilityname}}',
                                '{{$d->owner}}',
                                '{{$d->facid}}',
                                '{{$d->rgnid}}',
                                '{{$d->street_number}}',
                                '{{$d->street_name}}',
                                '{{$d->zipcode}}',
                                '{{$d->ownerMobile}}',
                                '{{$d->ownerEmail}}',
                                '{{$d->ocid}}',
                                '{{$d->mailingAddress}}',
                                '{{$d->approvingauthority}}',
                                '{{$d->approvingauthoritypos}}',
                                '{{$d->facmode}}',
                                '{{$d->funcid}}',
                                '{{$d->provid}}',
                                '{{$d->cmid}}',
                                '{{$d->brgyid}}',
                                '{{$d->classid}}',
                                '{{$d->subClassid}}',

                            )" data-toggle="modal" data-target="#myModal"><i class="fas fa-eye"></i></button></td>
                        </tr>
                    @endforeach	
                @else
                    <tr>
                        <td colspan="2" class="text-center">No Records found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </form>
    </div>
    
    <div class="col-md-12 text-center">
        <h3 class="text-uppercase font-weight-bold">List of  {{$addon_serv_desc}}</h3>
    </div>
    @php
        $_aptid = $aptid;
        $_aptdesc = "Change Request";
        $_dispSubmit = true;
        $_dispData = "Update Details";
    @endphp      
    <div class="col-md-12">  
        <form id="addOnForm">
            {{csrf_field()}}
            <input type="hidden" name="uid" id="uid" value="{{isset($user->uid) ? $user->uid : '' }}"/>
            <input type="hidden" name="appid" id="appid" />

            <div class="row">
                <div class="text-center">
                    <a class="btn btn-success action-btn" href="#" title="Add New Assessment Part" data-toggle="modal" data-target="#addOnService">
                        <i class="fa fa-plus-circle"></i>&nbsp;Add new
                    </a>
                </div>
            </div>
            <table class="table display" id="example" style="overflow-x: scroll;">
                <thead>
                    <tr>
                        <th class="text-center" style="width:  auto">Description</th>
                        <th class="text-center" style="width: auto;text-align: center">Type</th>
                        <th class="text-center" style="width: auto;text-align: center">Details</th>
                        <th class="text-center" style="width:  auto">
                            <center>Options</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data))
                    @foreach ($data as $d)
                        <tr>
                            <td class="text-center">{{$d->hgpdesc}}</td>
                            <td class="text-center">{{$d->owner}}</td>
                            <td class="text-center">{{$d->owner}}</td>
                            <td class="text-center"><button class="btn-primarys" onclick="showData(
                                '{{$d->facilityname}}',
                                '{{$d->owner}}',
                                '{{$d->facid}}',
                                '{{$d->rgnid}}',
                                '{{$d->street_number}}',
                                '{{$d->street_name}}',
                                '{{$d->zipcode}}',
                                '{{$d->ownerMobile}}',
                                '{{$d->ownerEmail}}',
                                '{{$d->ocid}}',
                                '{{$d->mailingAddress}}',
                                '{{$d->approvingauthority}}',
                                '{{$d->approvingauthoritypos}}',
                                '{{$d->facmode}}',
                                '{{$d->funcid}}',
                                '{{$d->provid}}',
                                '{{$d->cmid}}',
                                '{{$d->brgyid}}',
                                '{{$d->classid}}',
                                '{{$d->subClassid}}',

                            )" data-toggle="modal" data-target="#myModal"><i class="fas fa-eye"></i></button></td>
                        </tr>
                    @endforeach	
                @else
                    <tr>
                        <td colspan="4" class="text-center">No Records found.</td>
                    </tr>
                @endif
                
                </tbody>
            </table>
        </form>
    </div>
</div>


<div class="modal fade" id="mainService" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Add New {{$main_serv_desc}}</strong></h5>
                <hr>
                <div class="container">
                    <form id="frmMainService" class="row" data-parsley-validate="" novalidate="">
                        <input type="hidden" name="_token" value="">
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="col-sm-4">{{$main_serv_desc}}:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <select name="newserv" id="newserv" class="form-control select2-hidden-accessible" style="width: 100%" data-select2-id="newserv" tabindex="-1" aria-hidden="true">
                                <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                <option value="AC">AC - Acute Chronic</option>
                            </select>
                        </div>						
                        <br/>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success form-control" style="border-radius:0;">
                                <span class="fa fa-sign-up"></span>Save
                            </button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addOnService" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Add New {{$addon_serv_desc}}</strong></h5>
                <hr>
                <div class="container">
                    <form id="frmAddOnService" class="row" data-parsley-validate="" novalidate="">
                        <input type="hidden" name="_token" value="">
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="col-sm-4">{{$addon_serv_desc}}:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <select name="newserv" id="newserv" class="form-control select2-hidden-accessible" style="width: 100%:" data-select2-id="newserv" tabindex="-1" aria-hidden="true">
                                <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                <option value="AC">AC - Acute Chronic</option>
                            </select>
                        </div>			
                        <div class="col-sm-4">Type:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <select name="newserv" id="newserv" class="form-control select2-hidden-accessible" style="width: 100%:" data-select2-id="newserv" tabindex="-1" aria-hidden="true">
                                <option value="" disabled="" readonly="" hidden="" selected="" data-select2-id="2">Please Select</option>
                                <option value="AC">AC - Acute Chronic</option>
                            </select>
                        </div>					
                        <div class="col-sm-4">Details:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>Part Code</strong> required" class="form-control" required="">
                        </div>	
                        <br/>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success form-control" style="border-radius:0;">
                                <span class="fa fa-sign-up"></span>Save
                            </button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="clickable"> </div>
@include('dashboard.client.modal.facilityname-helper')