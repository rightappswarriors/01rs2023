@extends('main')
@section('content')
@include('client1.cmp.__home')
<body>
    @include('client1.cmp.nav')
    @include('client1.cmp.breadcrumb')
    @include('client1.cmp.msg')
    @include('dashboard.client.templates.step')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style type="text/css">
        #style-15::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }
        #style-15::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }
        #style-15::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #FFF;
            background-image: -webkit-gradient(linear, 40% 0%, 75% 84%, from(#4D9C41), to(#19911D), color-stop(.6, #54DE5D))
        }
        .action-btn {  margin:20px; }
        .feedback {  width: 100%;  display: block; }
        .custom-selectpicker { border: 1px solid #ced4da; }
        .region { display: none; }
        .province { display: none;}
    </style>
    @include('dashboard.client.forms.loadertyle')

    <div style="display: block;" id="myDivLo">
        <div class="container-fluid mt-5 mb-5">

            <!--- Change Request Form -->
            <div class="row">
                <div class="col-md-8">                    
                    <section class="container-fluid"> 
                        @include('dashboard.client.forms.parts.printbutton')                   
                        <h2 class="text-center pt-2">  <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="width:50px;"/>
                            &nbsp;&nbsp;&nbsp;CHANGE REQUEST FORM
                        </h2>
                    </section>
                </div>
                <div class="col-md-4"></div>

                <div class="col-md-12">   
                    <section class="container-fluid"> 
                        <ol class="breadcrumb" style="background-color: transparent !important;">
                            <li class="breadcrumb-item active">
                                <a href="{{asset('client1/changerequest')}}/{{$registered_facility->regfac_id}}/main" style="color: inherit; text-decoration: none;"> Main Form</a>
                            </li>
                        </ol>
                    </section>
                </div>
            </div>

            <div class="row">         

                <div class="col-md-8">
                    <section class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <p class="lead text-center text-danger">Please note: Red asterisk (*) is a required field and may be encountered throughout the system </p>
                            </div>

                            <div class="card-body" style="border: thin solid #f5f5f5; background-color: #f5f5f5;">
                                <div class="row">                                     
                                    @include('dashboard.client.forms.parts-change.main-form')
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">  
                                    <!---  Main Form  -->
                                    @if($functype == 'av')
                                        @include('dashboard.client.forms.ambulance-vehicle-form')
                                    @elseif($functype == 'cs')
                                        @include('dashboard.client.forms.change-service-form')
                                    @else
                                        @include('dashboard.client.forms.parts-change.main-form-action-button')
                                        @include('dashboard.client.forms.parts-change.list-of-change-details')
                                    @endif
                                    <!---  Main Form  -->
                                </div>

                                <!---  Main Form Submit -->
                                @if($functype == 'av')

                                @elseif($functype == 'cs')

                                @else
                                    @isset($appid)
                                        @if($appid > 0)
                                            <div class="row">
                                                <div class="col-md-12"><hr/></div>
                                                <div class="col-md-12 text-center">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary action-btn"  style="margin:auto; margin-top:10px;" value="submit" name="submit" id="submit" data-toggle="modal" data-target="#confirmSubmitModalLto">
                                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Submit Application and Proceed to Requirements
                                                        </button>                                            
                                                    </div> 
                                                </div>                                    
                                            </div>

                                            <form id="change_mainform" action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="cat_id" id="cat_id" value="100000">
                                                <input type="hidden" name="appid" id="appid" value="{{$registered_facility->appid}}">         
                                                <input type="hidden" name="regfac_id" id="regfac_id" value="{{$registered_facility->regfac_id}}">  
                                                <input type="hidden" class="form-control" id="aptidnew" name="aptidnew" value="IC">       
                                                <input type="hidden" class="form-control" id="aptid" name="aptid" value="IC">       
                                                <input id="saveasn"  name="saveasn" value="partial" type="hidden" />
                                                @include('dashboard.client.forms.parts-change.modal-submission-confirmation')
                                            </form>  
                                        @endif
                                    @endisset
                                @endif
                                <!---  Main Form  -->
                            </div>
                        </div>
                    </section>
                </div>
                <!-- end of initial change form -->
                <div class="col-md-4">
                    @if($functype == 'av')
                        @include('dashboard.client.forms.parts.payment.payment-form')
                    @elseif($functype == 'cs')
                        @include('dashboard.client.forms.parts.payment.payment-form')
                    @else
                        @include('dashboard.client.forms.parts.payment.payment-form-change')
                    @endif
                </div>
            </div>
        </div>
    </div>
    

    @include('dashboard.client.forms.loaderscript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>  const base_url = '{{URL::to('/')}}';     </script>
    <script src="{{asset('ra-idlis/public/js/clients/application-form.js')}}"></script>

    @include('client1.cmp.footer')
    @include('dashboard.client.forms.generalFormScript')
    

    @if($functype == 'cs')
        <style>
            #asc-H1-REGIS, #asc-H2-REGIS, #asc-H3-REGIS, .change-div {    display: none !important;   }
        </style>
        <script>
            var savStat = "partial";
            var apptypenew = '{!! $apptypenew !!}';

            if(savStat == "final")
            {
                document.getElementById('submit').setAttribute("hidden", "hidden");
                document.getElementById('save').setAttribute("hidden", "hidden");
                var update =  document.getElementById('update');

                if(update){     document.getElementById('update').removeAttribute("hidden");    }
            }
        </script>
        <script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>

        @include('dashboard.client.forms.parts.license-to-operate.new_ftr')
        @include('dashboard.client.forms.parts.license-to-operate.lto-form-submission')
        @include('dashboard.client.get_fees')
    @endif

</body>
@endsection