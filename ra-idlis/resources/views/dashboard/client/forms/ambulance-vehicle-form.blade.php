<div class="card-body">
    <form action="{{asset('/client1/apply/change_request_submit')}}" method="POST" class="row">
        {{ csrf_field() }}
        <!-- Application Details -->
        <input type="hidden" name="cat_id" id="cat_id" value="3">
        <input type="hidden" name="uid" id="uid" value="{{$uid}}">
        <input type="hidden" name="appid" id="appid" value="{{$registered_facility->appid}}">         
        <input type="hidden" name="regfac_id" id="regfac_id" value="{{$registered_facility->regfac_id}}">     
        <input type="hidden" name="noofbed_old" id="noofbed_old" value="{{number_format($registered_facility->noofbed,0)}}">            

        <div class=" ambuDetails" style="width: 100%;">
            <div class="col-md-12 ">
                <strong class="text-primary "> Ambulance Details:</strong>
            </div>
            <!-- <div class="showifHospital ambuDetails" style="width: 100%;" hidden> -->

            <div class="col-md-12">
                <span class="text-danger">NOTE: For Owned ambulance, Payments are as follows:</span> <br>
                Ambulance Service Provider = ₱ 5,000
                Ambulance Unit (Per Unit) = ₱ 1,000
            </div>
            <div style="width:95%; padding-left: 35px">
                <div class="mb-2 col-md-12">&nbsp;</div>


                <div class="row col-border-right showAmb">
                
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td> <button class="btn btn-success" id="buttonId"><i class="fa fa-plus-circle"></i></button> </td>
                                <th>Ambulance Service(Type 1, Type 2)</th>
                                <th>Ambulance Type(Owned, Outsoured)</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody id="body_amb">
                            <tr id="tr_amb" hidden>
                                <!-- preventDef -->
                                <!-- onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }" -->
                                <!-- onClick="$(this).closest('tr').remove();" -->
                                <td onclick="preventDef()"> <button class="btn btn-danger " onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }"><i class="fa fa-minus-circle"></i></button> </td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="typeamb"><i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Lorem ipsum dolar"></i></label>
                                        </div>
                                        <select class="form-control ctyamb" id="typeamb" name="typeamb">
                                            <option selected value hidden disabled>Please select</option>
                                            <option value="1">Type 1 (Basic Life Support)</option>
                                            <option value="2">Type 2 (Advance Life Support)</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <select class="form-control cambt" id="ambtyp" name="ambtyp">
                                        <option selected value hidden disabled>Please Select</option>
                                        <option value="1">Outsourced</option>
                                        <option value="2">Owned</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md">
                                            <input type="text" class="form-control cpn" id="plate_number" name="plate_number" placeholder="Plate Number/Conduction Sticker">
                                        </div>
                                        <div class="col-md" id="ambownerdiv" hidden>
                                            <input type="text" class="form-control" id="ambOwner" name="ambOwner" placeholder="Owner">
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div  style="margin:auto; margin-top:10px;">
            <a href="{{asset('client1/changerequest')}}/{{$registered_facility->regfac_id}}/main" class="btn btn-secondary action-btn">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Main Form
            </a>
            <button type="submit" class="btn btn-primary action-btn" >
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Back to Main Form
            </button>
        </div>
    </form>
</div>

<script>         
    function initialAmbulDetails(typeamb, ambtyp, plate_number, ambOwner){

        if(typeamb.length > 0){

            var nltypa =  document.getElementById("tr_amb" ).querySelectorAll('#typeamb');
            nltypa[0].value = typeamb[0];  
            
            var nlamntyp =  document.getElementById("tr_amb" ).querySelectorAll('#ambtyp');
            nlamntyp[0].value = ambtyp[0]; 

            var nlpn =  document.getElementById("tr_amb" ).querySelectorAll('#plate_number');
            nlpn[0].value = plate_number[0]; 

            var nlao =  document.getElementById("tr_amb" ).querySelectorAll('#ambOwner');
            var nlaodiv =  document.getElementById("tr_amb" ).querySelectorAll('#ambownerdiv');
            
            if(ambtyp[0] == 1){
                nlaodiv[0].removeAttribute('hidden')
                nlao[0].value = ambOwner[0]; 
            }
                                    
            for(var ta = 1; ta < typeamb.length ; ta++){
            
                var trAdon =   document.getElementById("tr_amb");
                var cln = trAdon.cloneNode(true);
                cln.removeAttribute("id");
                cln.removeAttribute("hidden");
                cln.setAttribute("class", "tr_amb");
                cln.className += cln.className ? " "+"amb"+ta : "amb"+ta
                document.getElementById("body_amb").appendChild(cln);

                var nltypa =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#typeamb');
                nltypa[0].value = typeamb[ta]; 

                var nlamntyp =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#ambtyp');
                nlamntyp[0].value = ambtyp[ta]; 

                var nlpn =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#plate_number');
                nlpn[0].value = plate_number[ta];                  

                var nlao =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#ambOwner');
                var nlaodiv =  document.getElementsByClassName("amb"+ta )[0].querySelectorAll('#ambownerdiv');

                if(ambtyp[ta] == 1){
                    nlaodiv[0].removeAttribute('hidden')
                    nlao[0].value = ambOwner[ta]; 
                }            
            }
        }
    }
    document.getElementById("buttonId").addEventListener("click", function(event) {
        event.preventDefault()
        var itm = document.getElementById("tr_amb");
        var cln = itm.cloneNode(true);
        cln.removeAttribute("id");
        cln.removeAttribute("hidden");
        cln.setAttribute("class", "tr_amb");
        document.getElementById("body_amb").appendChild(cln);
    });
</script>