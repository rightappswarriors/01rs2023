@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Charges Master File')
  @section('content')
   <input type="text" id="CurrentPage" hidden="" value="PY003">

  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($Chrges))
          @foreach ($Chrges as $Chrge)
          <option value="{{$Chrge->chg_code}}">{{$Chrge->chg_desc}}</option>
        @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Charge Fees 
             <span class="PY003_add"><a href="#" title="Add New Charges" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
              
          </div>
          <div class="card-body">

                <table class="table table-striped table-bordered table-sm " id="example" cellspacing="0"  width="100%" height="100%">
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Ref No.</th>
                    <th>Explaination</th>
                    <th>Remarks</th>

                    <th>App Type</th>
                    <th>Category</th>
                    <th>Facility Type</th>
                    <th>Sub</th>
                    <th>Ownership</th>
                    <th>Assigned</th>
                    <th>For Floor Plan Repayment?</th>
                    <th>ChgCategory</th>

                    <th>IN Amnt</th>
                    <th>IC Amnt</th>
                    <th>Renewal</th>
                    <th>Penalty</th>

                    <th><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($list))
                  @foreach ($list as $Chrge)
                    <tr>
                      <td scope="row" style="font-weight: bold"> {{$Chrge->chg_code}}</td>
                      <td>{{$Chrge->chg_desc}}</td>
                      <td>{{$Chrge->chg_desc}}</td> <!-- Ref No -->
                      <td>{{$Chrge->chg_exp}}</td>
                      <td>{{$Chrge->chg_rmks}}</td>
                      
                      <td>{{$Chrge->chg_desc}}</td> <!-- App Type -->
                      <td>{{$Chrge->cat_id}} - {{$Chrge->cat_desc}}</td> <!-- Category -->
                      <td>{{((isset($Chrge->hgpdesc)) ? $Chrge->hgpdesc : '----')}}</td> <!-- Facility Type -->
                      <td>{{((isset($Chrge->hgpdesc)) ? $Chrge->hgpdesc : '----')}}</td> <!-- sub -->
                      <td>{{((isset($Chrge->hgpdesc)) ? $Chrge->hgpdesc : '----')}}</td> <!-- Ownership -->                      
                      <td>{{$Chrge->chg_desc}}</td> <!-- Assigned -->
                      <td scope="row" style="font-weight: bold"> {{($Chrge->fprevision == 1 ? 'Yes' : 'No')}}</td> <!-- For Floor Plan Repayment -->          
                      <td>{{$Chrge->chg_desc}}</td> <!-- Assigned -->
                      
                      <td>{{$Chrge->chg_desc}}</td> <!-- IN Amnt -->
                      <td>{{$Chrge->chg_desc}}</td> <!-- IC Amnt -->
                      <td>{{$Chrge->chg_desc}}</td> <!-- Renewal Amnt -->
                      <td>{{$Chrge->chg_desc}}</td> <!-- Penalty Amnt -->

                      <td>
                        <center>
                          <span class="PY003_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$Chrge->chg_code}}', '{{$Chrge->cat_id}}', '{{$Chrge->hgpid}}', '{{$Chrge->chg_desc}}', '{{$Chrge->chg_exp}}', '{{$Chrge->chg_rmks}}','{{$Chrge->fprevision}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="PY003_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$Chrge->chg_code}}', '{{$Chrge->chg_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                          </span>
                        </center>
                      </td>
                    </tr>
                  @endforeach
                  @endif
                </tbody>

                <tfoot>
                  <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Ref No.</th>
                    <th>Explaination</th>
                    <th>Remarks</th>

                    <th>App Type</th>
                    <th>Category</th>
                    <th>Facility Type</th>
                    <th>Sub</th>
                    <th>Ownership</th>
                    <th>Assigned</th>
                    <th>For Floor Plan Repayment?</th>
                    <th>ChgCategory</th>

                    <th>IN Amnt</th>
                    <th>IC Amnt</th>
                    <th>Renewal</th>
                    <th>Penalty</th>

                    <th><center>Options</center></th>
                  </tr>
                </tfoot>

              </table>

          </div>
      </div>
  </div>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modals-default" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body">
          <h5 class="modal-title text-center"><strong>Add New Charge</strong></h5>
          <hr>
          <div class="container">
            <form id="addRgn" class="row"  data-parsley-validate>
              <div class="col-lg-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                <div class="row">
                </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                  <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              
              {{ csrf_field() }}
              <div class="col-lg-12 row">
                <div class="col-lg-6">
                   <div class="row">
                    <div class="col-lg-4">App Type:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="new_cat" data-parsley-required-message="*<strong>Category</strong> required" required>
                          <option value="">Select Application Type ...</option>
                          @if ($AppType)
                            @foreach ($AppType as $data)
                              <option value="{{$data->hfser_id}}">{{$data->hfser_id}} - {{$data->hfser_desc}} </option>
                            @endforeach
                      @endif
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                   <div class="row">
                      <div class="col-lg-4">Category:</div>
                      <div class="col-lg-8" style="margin:0 0 .8em 0;">
                        <select class="form-control" id="new_cat" data-parsley-required-message="*<strong>Category</strong> required" required>
                            <option value="">Select Category ...</option>
                            @if ($Categorys)
                              @foreach ($Categorys as $data)
                                <option value="{{$data->cat_id}}">{{$data->cat_id}} - {{$data->cat_desc}} </option>
                              @endforeach
                        @endif
                        </select>
                      </div>
                    </div>
                </div>
              </div>

              <div class="col-lg-12 row">
                <div class="col-lg-6">
                   <div class="row">
                    <div class="col-lg-4">Facility Type:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="new_hgpid" data-parsley-required-message="*<strong>Category</strong> required" required>
                          <option value="">Select Facility Type ...</option>
                          @if ($Facility)
                            @foreach ($Facility as $data1)
                              <option value="{{$data1->hgpid}}">{{$data1->hgpid}} - {{$data1->hgpdesc}} </option>
                            @endforeach
                      @endif
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-4">Hospital Level:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="new_cat" data-parsley-required-message="*<strong>Category</strong> required" required>
                          <option value="">Select Hospital Level ...</option>
                          @if (isset($allHosplevel ))
                            @foreach ($allHosplevel as $data)
                              <option value="{{$data->facid}}">{{$data->facid}} - {{$data->grp_name}} </option>
                            @endforeach
                      @endif
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 row">
                <div class="col-lg-6">
                   <div class="row">
                    <div class="col-lg-4">Ownership:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="new_hgpid" data-parsley-required-message="*<strong>Category</strong> required" required>
                          <option value="">Select Ownership Type ...</option>
                          @if ($listOwnership)
                            @foreach ($listOwnership as $data1)
                              <option value="{{$data1->ocid}}">{{$data1->ocid}} - {{$data1->ocdesc}} </option>
                            @endforeach
                      @endif
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                   <div class="row">
                    <div class="col-lg-4">UACS Link:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="new_hgpid" data-parsley-required-message="*<strong>Category</strong> required" required>
                          <option value="">Select UACS Link ...</option>
                          @if ($listUACS)
                            @foreach ($listUACS as $data1)
                              <option value="{{$data1->m04ID}}">{{$data1->m04ID}} - {{$data1->m04Desc}} </option>
                            @endforeach
                      @endif
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            
              <div class="col-lg-12 row">
                <div class="col-lg-6">
                   <div class="row">
                    <div class="col-lg-4">Class:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="new_hgpid" data-parsley-required-message="*<strong>Category</strong> required" required>
                          <option value="">Select Class Type ...</option>
                          @if ($allclass)
                            @foreach ($allclass as $data1)
                              <option value="{{$data1->classid}}">{{$data1->classid}} - {{$data1->classname}} </option>
                            @endforeach
                      @endif
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                   <div class="row">
                    <div class="col-lg-4">Subclass:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="new_hgpid" data-parsley-required-message="*<strong>Category</strong> required" required>
                          <option value="">Select Subclass Link ...</option>
                          @if ($allsubclass)
                            @foreach ($allsubclass as $data1)
                              <option value="{{$data1->classid}}">{{$data1->classid}} - {{$data1->classname}} </option>
                            @endforeach
                      @endif
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 row">
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-4">Code:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                      <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>Code</strong> required"  class="form-control"  required>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-4">Description:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                      <input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 row">
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-4">Explanation:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                    <textarea type="text" rows="4" id="new_explanation" class="form-control" data-parsley-required-message="*<strong>Explanation</strong> required" required></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-4">Remarks:</div>
                    <div class="col-lg-8" style="margin:0 0 .8em 0;">
                    <textarea type="text" rows="4" id="new_remark" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-12 row">

                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-4">
                        &nbsp;Initial New</div>
                    <div class="col-lg-8">
                      <input type="number" id="amnt_new" class="form-control" data-parsley-required-message="*<strong>Initial New Amount</strong> required" required>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-4">&nbsp;Renewal</div>
                    <div class="col-lg-8">
                      <input type="number" id="amnt_renewal" class="form-control" data-parsley-required-message="*<strong>Renewal Amount</strong> required" required>
                    </div>
                  </div>
                </div>

              </div>

              <div class="col-lg-12 row">

                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-4">
                        &nbsp;Penalty</div>
                    <div class="col-lg-8">
                      <input type="number" id="amnt_penalty" class="form-control" data-parsley-required-message="*<strong>Initial New Amount</strong> required" required>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-4">&nbsp;Renewal Period</div>
                    <div class="col-lg-8">
                      <input type="number" id="renewal_period" class="form-control" data-parsley-required-message="*<strong>Renewal Amount</strong> required" required>
                    </div>
                  </div>
                </div>

              </div>
              
              <div class="col-lg-12">&nbsp;</div>

              <div class="col-lg-12">
                <button type="submit" class="btn btn-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
              </div> 
            </form>

         </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Edit Charge</strong></h5>
                <hr>
                <div class="container">
                      <form id="EditNow" data-parsley-validate>
                      <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
                        <div class="row">
                        </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                          <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <span id="EditBody"></span>
                      <div class="row">
                        <div class="col-sm-6">
                        <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
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
  <div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Delete Charge</strong></h5>
            <hr>
            <div class="container">
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DelErrorAlert" role="alert">
                    <div class="row">
                    </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              <span id="DelModSpan"></span>
              <hr>
                  <div class="row">
                    <div class="col-sm-6">
                    <button type="button" onclick="deleteNow();" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                  </div> 
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                  </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <style>
    .content { width: 85%; margin: 0 auto;}
  </style>

  <script type="text/javascript">
    $(document).ready(function () {
          $('#example').DataTable({
            "scrollX": true,
            "scrollY": true,
          });
        });

    //$(document).ready(function() {$('#example').DataTable(
   //         "scrollX": true,
   //         "scrollY": 200,
    //      });});

    function showData(id,cat_id,hgpid,desc,expl,ts,isAssess){
        $('#EditBody').empty();
        $('#EditBody').append(
            '<div class="col-sm-4">Code:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_name" class="form-control" value="'+id+'" disabled>' +
            '</div>' +
            '<div class="col-sm-4">Category:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<select class="form-control" id="edit_cat" data-parsley-required-message="*<strong>Category</strong> required" required>' +
                  '<option value="">Select Category ...</option>' +
                  @if ($Categorys)
                    @foreach ($Categorys as $categords)
                        '<option value="{{$categords->cat_id}}" '+((cat_id == "{{$categords->cat_id}}") ? 'selected' : '')+'>{{$categords->cat_id}} - {{$categords->cat_desc}} </option>' +
                    @endforeach
                  @endif
              '</select>' +
            '</div>' +
            '<div class="col-sm-4">Facility Type:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<select class="form-control" id="edit_hgpid">' +
                  '<option value="">Select Category ...</option>' +
                  @if ($Facility)
                    @foreach ($Facility as $faciladsf)
                        '<option value="{{$faciladsf->hgpid}}" '+((hgpid == "{{$faciladsf->hgpid}}") ? 'selected' : '')+'> {{$faciladsf->hgpdesc}} </option>' +
                    @endforeach
                  @endif
              '</select>' +
            '</div>' +
            '<div class="col-sm-4">Description:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
            '</div>' +
            '<div class="col-sm-4">Explanation:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<textarea rows="4" id="edit_exp" value="'+expl+'" data-parsley-required-message="<strong>*</strong>Explanation <strong>Required</strong>" placeholder="'+expl+'" class="form-control" required>'+expl+'</textarea>' +
            '</div>'  +
            '<div class="col-sm-4">Remarks:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">'  +
                  '<textarea rows="3" id="edit_exp23" value="'+ts+'" data-parsley-required-message="<strong>*</strong>Explanation <strong>Required</strong>" placeholder="'+ts+'" class="form-control">'+ts+'</textarea>' +
            '</div>'+
            '<div class="col-sm-4">for Floor Plan Re-Evaluation?:</div>'+
              '<div class="col-sm-12 d-flex justify-content-center" style="margin:0 0 .8em 0;">'+
                '<div class="row">'+
                  '<div class="col-md-6">'+
                      '<div class="col-md">'+
                        '<label class="form-check-label" for="exampleRadios1">'+
                          'Yes'+
                          '<input type="radio" class="form-control" id="exampleRadios1" name="isAssessEdit" value="1">'+
                        '</label>'+
                      '</div>'+
                  '</div>'+
                  '<div class="col-md-6">'+
                      '<div class="col-md">'+
                        '<label class="form-check-label" for="exampleRadios2">'+
                          'No'+
                          '<input type="radio" class="form-control" id="exampleRadios2" name="isAssessEdit" value="0" checked="">'+
                        '</label>'+
                      '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'
          );
          $("input[name=isAssessEdit][value="+isAssess+"]").prop('checked',true)
      }
      function showDelete (id,desc){
              $('#DelModSpan').empty();
              $('#DelModSpan').append(
                  '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>('+id+') - ' + desc + '</strong></span>?' +
                    // <input type="text" id="edit_desc2" class="form-control"  style="margin:0 0 .8em 0;" required>
                  '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
                  '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
                  '</div>'
                );
          } 
      $('#addRgn').on('submit',function(event){
              event.preventDefault();
              var form = $(this);
              form.parsley().validate();
              if (form.parsley().isValid()) {
                  var id = $('#new_rgnid').val();
                  var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
                  var test = $.inArray(id,arr);
                  if (test == -1) { // Not in Array
                      $.ajax({
                        method: 'POST',
                        data: {
                          _token : $('#token').val(),
                          cat_id : $('#new_cat').val(),
                          hgpid : $('#new_hgpid').val(),
                          id: $('#new_rgnid').val(),
                          name : $('#new_rgn_desc').val(),
                          exp : $('#new_explanation').val(),
                          rmk : $('#new_remark').val(),
                          isAssess : $('input[name=isAssess]').val()
                        },
                        success: function(data) {
                          if (data == 'DONE') {
                              alert('Successfully Added New Charge');
                              window.location.href = "{{ asset('/employee/dashboard/mf/charges') }}";
                          } else if (data == 'ERROR') {
                              $('#AddErrorAlert').show(100);      
                          }
                        }, error : function (XMLHttpRequest, textStatus, errorThrown){
                             $('#AddErrorAlert').show(100);     
                        }
                    });
                  } else {
                    alert('Charge code is already been taken');
                    $('#new_rgnid').focus();
                  }
              }
          });
      $('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              form.parsley().validate();
               if (form.parsley().isValid()) {
                 var x = $('#edit_name').val();
                 var y = $('#edit_desc').val();
                 $.ajax({
                    url: "{{ asset('employee/mf/save_charge') }}",
                    method: 'POST',
                    data : {_token:$('#token').val(),code:x,desc:y,exp : $('#edit_exp').val(),rmk:$('#edit_exp23').val(),cat_id:$('#edit_cat').val(),hgpid:$('#edit_hgpid').val(), revision:  $("input[name=isAssessEdit]:checked").val()},
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Charge');
                            window.location.href = "{{ asset('/employee/dashboard/mf/charges') }}";
                        } else {
                            $('#EditErrorAlert').show(100);
                        }
                    }, error : function(XMLHttpRequest, textStatus, errorThrown){
                        $('#EditErrorAlert').show(100);
                    }
                 });
               }
          });
      function deleteNow(){
            var id = $("#toBeDeletedID").val();
            var name = $("#toBeDeletedname").val();
            $.ajax({
              url : "{{ asset('employee/mf/del_charge') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id, mod_id : $('#CurrentPage').val()},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+name);
                  window.location.href = "{{ asset('/employee/dashboard/mf/charges') }}";
                } else if (data == 'ERROR') {
                    $('#DelErrorAlert').show(100);
                } 
              }, // 
              error : function(XMLHttpRequest, textStatus, errorThrown){
                $('#DelErrorAlert').show(100);
              }
            });
          }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif