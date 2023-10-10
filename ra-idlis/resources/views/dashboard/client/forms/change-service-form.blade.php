<div  class="card-body">
    @php
        $_aptid = $aptid;
        $_aptdesc = "Change Request";
        $_dispSubmit = true;
        $_dispData = "Update Details";
    @endphp        
    <form id="ltoForm" class="row">
        {{csrf_field()}}
        <input type="hidden" name="uid" id="uid" value="{{isset($user->uid) ? $user->uid : '' }}"/>
        <input type="hidden" name="appid" id="appid" />              
        
        {{-- LTO Type of Facility --}}
        @include('dashboard.client.forms.parts.license-to-operate.type-of-facility')

        {{-- LTO Class of Hospitals --}}
        @include('dashboard.client.forms.parts.license-to-operate.classification-of-hospital')

        {{-- LTO For Hospital --}}
        @include('dashboard.client.forms.parts.license-to-operate.for-hospital')

        {{-- LTO Ancillary/Clinical Services --}}
        <div>
        @include('dashboard.client.forms.parts.license-to-operate.ancillary-clinical-services')

        {{-- LTO For Dialysis Clinic --}}
        @include('dashboard.client.forms.parts.license-to-operate.for-dialysis-clinic')

        {{-- LTO For Ambulatory Surgical Clinic --}}
        @include('dashboard.client.forms.parts.license-to-operate.for-ambulatory-surgical-clinic')

        {{-- no. of dialysis station --}}
            @include('dashboard.client.forms.parts.num-dialysis')
        
        {{-- LTO Add-On Services --}}
        @include('dashboard.client.forms.parts.license-to-operate.add-on-services')                       

        {{-- LTO For Ambulance Details --}}
        @include('dashboard.client.forms.parts.license-to-operate.for-ambulance-details')

        {{-- LTO Other Clinical Service(s) --}}
        @include('dashboard.client.forms.parts.license-to-operate.other-clinic-services')

        {{-- LTO For Clinical Laboratory --}}
        @include('dashboard.client.forms.parts.license-to-operate.for-clinical-laboratory')

        <div class="text-center" style="margin:auto; margin-top:10px;">
            <a href="{{asset('client1/changerequest')}}/{{$registered_facility->regfac_id}}/main" class="btn btn-secondary action-btn">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Main Form
            </a>
            <button id="submit"  class="btn btn-info btn-block" type="button" value="submit" name="submit" data-toggle="modal" data-target="#confirmSubmitModalLto">
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Back to Main Form
            </button>
        </div>
    </form>
</div>

<div class="modal fade" id="confirmSubmitModalLto" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmSubmitModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <p class="lead"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <b>Are you sure you want to submit form?</b></p>
                    <p>Please check and review your application form before submitting.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" onclick="setTimeout(function() {window.print()}, 10); ">
                    <i class="fa fa-eye" aria-hidden="true"></i> Preview
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    No, Recheck details
                </button>
                <button onClick="savePartialLto('final')" type="button" class="btn btn-success" data-dismiss="modal">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    Proceed
                </button>
            </div>
        </div>
    </div>
</div>
<div id="clickable"> </div>
@include('dashboard.client.modal.facilityname-helper')