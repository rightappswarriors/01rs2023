@php 
    $_aptid = $aptid;
    $_aptdesc = "Change Request";
    $_dispSubmit = true;
    $_dispData = "Update Details";

    $main_serv_desc = "Main Services"; 
    $addon_serv_desc = "Add Ons / Ancilliary / Other Services";
    $main_colspan = 2;
    $addon_colspan = 2;
@endphp
@if($isupdate == 1) @php ++$main_colspan; ++$addon_colspan; @endphp @endif
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a class="nav-link active" id="v-main-applied-tab" data-toggle="tab" href="#v-main-applied" role="tab" aria-controls="v-main-applied" aria-selected="true">
                        <i class="fa fa-file"></i> List of Services  to Apply
                    </a> 
                </li>
                <li>
                    <a class="nav-link" id="v-main-reg-tab" data-toggle="pill" href="#v-main-reg" role="tab" aria-controls="v-main-reg" aria-selected="false">
                        <i class="fa fa-check"></i> List of Registered Services
                    </a>
                </li>
            </ul>
            
            <div class="tab-content mt-5">	

                <div class="tab-pane active" id="v-main-applied">

                    <div class="col-md-12 text-center">
                        <h3 class="text-uppercase font-weight-bold">List of {{$main_serv_desc}} to Apply</h3>
                    </div>                  
                    <div class="col-md-12">  
                        <form id="mainForm">
                            {{csrf_field()}}
                            <input type="hidden" name="uid" id="uid" value="{{isset($user->uid) ? $user->uid : '' }}"/>
                            <input type="hidden" name="appid" id="appid" />      
                            {{-- @if($isaddnew == 1)        
                                <div class="row">
                                    <div class="text-center">
                                        <a class="btn btn-success action-btn" href="#" title="Add New {{$main_serv_desc}}" data-toggle="modal" data-target="#mainService">
                                            <i class="fa fa-plus-circle"></i>&nbsp;Add New {{$main_serv_desc}}
                                        </a>
                                    </div>
                                </div>
                            @endif        --}}
                            <table class="table display" id="example" style="overflow-x: scroll;">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center" style="width:  auto">From Service</th>
                                        <th colspan="2" class="text-center" style="width:  auto">To New Service</th>
                                        
                                        @if($isupdate == 1)        
                                            <th class="text-center" style="width:  auto">
                                                <center>Options</center>
                                            </th>
                                        @endif    
                                    </tr>
                                </thead>
                                <tbody>
                                @if (isset($mainservices_applied))
                                    @foreach ($mainservices_applied as $d)
                                        <tr>
                                            <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                            <td class="text-center">{{$d->facname}}</td>
                                            <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                            <td class="text-center">{{$d->facname}}</td>

                                            @if($isupdate == 1)   
                                                <td class="text-center"><button class="btn-primary" onclick="showData(
                                                    '{{$d->facid}}',
                                                    '{{$d->facname}}'

                                                )" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger " onclick=""><i class="fa fa-minus-circle"></i></button></td>
                                            @endif 
                                        </tr>
                                    @endforeach	
                                @else
                                    <tr>
                                        <td colspan="{{$main_colspan+2}}" class="text-center">No Records found.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <div class="col-md-12 text-center">
                        <h3 class="text-uppercase font-weight-bold">List of {{$addon_serv_desc}}  to Apply</h3>
                    </div> 
                    <div class="col-md-12">  
                        <form id="addOnForm">
                            {{csrf_field()}}
                            <input type="hidden" name="uid" id="uid" value="{{isset($user->uid) ? $user->uid : '' }}"/>
                            <input type="hidden" name="appid" id="appid" />
                            @if($isaddnew == 1)       
                                <div class="row">
                                    <div class="text-center">
                                        <a class="btn btn-success action-btn" href="#" title="Add New {{$addon_serv_desc}}" data-toggle="modal" data-target="#addOnService">
                                            <i class="fa fa-plus-circle"></i>&nbsp;Add New {{$addon_serv_desc}}
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <table class="table display" id="example" style="overflow-x: scroll;">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center" style="width:  auto">From Service</th>
                                        <th colspan="2" class="text-center" style="width:  auto">To New Service</th>
                                        {{-- <th class="text-center" style="width: auto;text-align: center">Type</th>
                                        <th class="text-center" style="width: auto;text-align: center">Details</th>  --}}
                                        @if($isupdate == 1)   
                                            <th class="text-center" style="width:  auto">
                                                <center>Options</center>
                                            </th>
                                        @endif 
                                    </tr>
                                </thead>
                                <tbody>
                                @php $proceed_addon = 0; @endphp
                                @if (isset($addOnservices_applied))
                                    @foreach ($addOnservices_applied as $d)
                                        @php $proceed_addon = 1; @endphp
                                        <tr>
                                            <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                            <td class="text-center">{{$d->facname}}</td>
                                            <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                            <td class="text-center">{{$d->facname}}</td>
                                            {{-- <td class="text-center">Owned</td>
                                            <td class="text-center">Remarks</td>  --}}
                                            @if($isupdate == 1)   
                                                <td class="text-center">
                                                    <button class="btn-primary" onclick="showData(
                                                    '{{$d->facid}}',
                                                    '{{$d->facname}}'
                                                    )" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger " onclick=""><i class="fa fa-minus-circle"></i></button>
                                                </td>
                                            @endif 
                                        </tr>
                                    @endforeach	
                                @endif
                                
                                @if($proceed_addon == 0)   
                                    <tr>
                                        <td colspan="{{$addon_colspan+2}}" class="text-center">No Records found.</td>
                                    </tr>
                                @endif
                                
                                </tbody>
                            </table>
                        </form>
                    </div>

                </div>
                <div class="tab-pane" id="v-main-reg">

                    <div class="col-md-12 text-center">
                        <h3 class="text-uppercase font-weight-bold">List of Registered {{$main_serv_desc}}</h3>
                    </div>                  
                    <div class="col-md-12">  
                        <table class="table display" id="example" style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:  auto">Group</th>
                                    <th class="text-center" style="width:  auto">Description</th> 
                                    @if($isupdate == 1)        
                                        <th class="text-center" style="width:  auto">
                                            <center>Options</center>
                                        </th>
                                    @endif   
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($mainservices_reg))
                                @foreach ($mainservices_reg as $d)
                                    <tr>
                                        <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                        <td class="text-center">{{$d->facname}}</td>

                                        @if($isupdate == 1)   
                                            <td class="text-center"><button class="btn-primary" onclick="showData(
                                                '{{$d->facid}}',
                                                '{{$d->facname}}'

                                            )" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></button></td>
                                        @endif 
                                    </tr>
                                @endforeach	
                            @else
                                <tr>
                                    <td colspan="2" class="text-center">No Records found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 text-center">
                        <h3 class="text-uppercase font-weight-bold">List of Registered {{$addon_serv_desc}}</h3>
                    </div> 
                    <div class="col-md-12">  
                        <table class="table display" id="example" style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:  auto">Group</th>
                                    <th class="text-center" style="width:  auto">Description</th>
                                    {{-- <th class="text-center" style="width: auto;text-align: center">Type</th>
                                    <th class="text-center" style="width: auto;text-align: center">Details</th>  --}}
                                    @if($isupdate == 1)        
                                        <th class="text-center" style="width:  auto">
                                            <center>Options</center>
                                        </th>
                                    @endif   
                                </tr>
                            </thead>
                            <tbody>
                            @php $proceed_addon = 0; @endphp
                            @if (isset($addOnservices_reg))
                                @foreach ($addOnservices_reg as $d)
                                    @php $proceed_addon = 1; @endphp
                                    <tr>
                                        <td class="text-center">{{$d->anc_name}}<br/><small style="color:#ccc">[{{$d->facid}}]</small> </td>
                                        <td class="text-center">{{$d->facname}}</td>
                                        {{-- <td class="text-center">Owned</td>
                                        <td class="text-center">Remarks</td>  --}}
                                        @if($isupdate == 1)   
                                            <td class="text-center">
                                                <button class="btn-primary" onclick="showData(
                                                '{{$d->facid}}',
                                                '{{$d->facname}}'
                                                )" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></button>
                                            </td>
                                        @endif 
                                    </tr>
                                @endforeach	
                            @endif
                            
                            @if($proceed_addon == 0)   
                                <tr>
                                    <td colspan="{{$addon_colspan}}" class="text-center">No Records found.</td>
                                </tr>
                            @endif
                            
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div> 
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