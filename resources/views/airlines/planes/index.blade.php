@extends('layouts.travel')

<style type="text/css">

   .checkboxes label {
    display: block !important;
    float: left !important;
    padding-right: 10px !important;
    width: 60px !important;
    margin-bottom: 5px !important;
    white-space: nowrap !important;
    }

   .checkboxes input {
    vertical-align: middle !important;
    width:20px !important;
    }

   .checkboxes label span {
    vertical-align: middle !important;
    margin-bottom: -50px !important;
    }

    .modal { overflow: auto !important; }
   </style>

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
<div class="pro-head">
            <h2>Airplanes</h2>
        </div>

      <div style="margin-bottom:20px;margin-left:10px;">
      <a data-toggle="modal" id="add" class="btn btn-primary" href="#modal-form">Add Airplane</a>&emsp;<a data-toggle="modal" id="report" href="#modal-report" class="btn btn-warning">Airplanes Report</a>
      </div>

      
           <form id="form" action="" enctype="multipart/form-data">
           {{ csrf_field() }}
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated fadeIn">
                                            
                                        <div class="modal-body">
                                        <div id="loading" style="display:none;">
                                         <div style="margin-top:5%;"><p id="sucessmessage">Saving data</p>
                                         <img src="{{url('/assets/images/ellipsis.svg')}}" alt="...." />
                                         </div>
                                         </div>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h3 id="title" class="m-t-none m-b">Create Airplane</h3>
                                             <input type="hidden" id="id" placeholder="Enter name" class="form-control">
                                             
                                             <div class="form-group"><label>Name <span style="color:red">*</span></label> 
                                             <select id="vid" class="form-control">
                                             <option value="">Select Airplane Name</option>
                                             @foreach($vehiclenames as $vehiclename)
                                             <option value="{{ $vehiclename->id }}"> {{ $vehiclename->name }}</option>
                                             @endforeach
                                             </select>
                                             <p id="selname" style="color:red"></p>
                                             </div>

                                             <div class="form-group"><label>Flight number <span style="color:red">*</span></label> 
                                             <input type="text" id="regno" placeholder="Enter Flight Number" class="form-control">
                                             <p id="insregno" style="color:red"></p>
                                             </div>

                                             <div class="form-group"><label>Capacity <span style="color:red">*</span></label> 
                                             <input type="text" id="capacity" placeholder="Enter Capacity" class="form-control">
                                             <p id="inscapacity" style="color:red"></p>
                                             </div>

                                             
                                         </div>
          
                                        <div class="modal-footer" style="margin-top: 60px !important">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

                                            <button type="button" id="submit" class="btn btn-primary sub-form">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>   

                        </form>   

                        <div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated fadeIn">
                                        <form target="_blank" action="{{url('report/vehicles')}}" method="post">     
                                        <div class="modal-body">
                                        
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h3 id="title" class="m-t-none m-b">Select Report Type</h3>
                                            
                                             {{ csrf_field() }}
                                             <div class="form-group"><label>Status <span style="color:red">*</span></label> 
                                            <select required="" id="status" name="status" class="form-control">
                                             <option value="">Select Airplane Status</option>
                                             <option value="1"> Active</option>
                                             <option value="0"> Inactive</option>
                                             <option value="all"> All</option>
                                             </select>
                                             <p id="destination" style="color:red"></p>
                                             </div>

                                             <div class="form-group"><label>Report Type <span style="color:red">*</span></label> 
                                            <select required="" id="type" name="type" class="form-control">
                                             <option value="">Select Report Type</option>
                                             <option value="pdf"> PDF</option>
                                             <option value="excel"> Excel</option>
                                             </select>
                                             <p id="destination" style="color:red"></p>
                                             </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

                                            <input type="submit" class="btn btn-primary sub-form" value="Select" />
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated fadeIn">
                                            
                                        <div class="modal-body">
                                        
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h3 id="title" class="m-t-none m-b">Airplane</h3>
                                        <table class="table table-bordered table-hover">

                                            <tr>
                                               <td><strong>Logo : </strong></td><td class="tdlogo"></td>
                                            </tr>

                                            <tr>
                                               <td><strong>Reporting number : </strong></td><td class="tdregno"></td>
                                            </tr>

                                            <tr>
                                               <td><strong>Name : </strong></td><td class="tdname"></td>
                                            </tr>

                                            <tr>
                                               <td><strong>Capacity : </strong></td><td class="tdcapacity"></td>
                                            </tr>

                                            <tr>
                                               <td><strong>Status : </strong></td><td class="tdstatus"></td>
                                            </tr>

                                        </table>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
       
        <div class="check-error alert alert-danger"></div>  
        <div class="table-responsive" style="border: none; min-height: 1000px !important"> 
        <table id="users" class="table table-condensed table-responsive table-hover">


      <thead style="background:#263949">

        <th style="color:#FFF">#</th>
        <th style="color:#FFF">Logo</th>
        <th style="color:#FFF">Flight Number</th>
        <th style="color:#FFF">Name</th>
        <th style="color:#FFF">Capacity</th>
        <th style="color:#FFF">Action</th>

      </thead>
      <tbody class="displayrecord">
      <?php $i=1;?>
      @foreach($vehicles as $vehicle)
        <tr class="{{'del'.$vehicle->id}}">
          <td>{{$i}}</td>
          <td><img src="{{url('/public/uploads/logo/'.$vehicle->vehiclename->logo)}}" width="100" height="100" alt="no logo" /></td>
          <td>{{$vehicle->regno}}</td>
          <td>{{$vehicle->vehiclename->name}}</td>
          <td>{{$vehicle->capacity}}</td>
          
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a class="view" data-toggle="modal" data-name="{{$vehicle->vehiclename->name}}" data-logo="{{$vehicle->vehiclename->logo}}" data-regno="{{$vehicle ->regno}}" data-id="{{$vehicle->id}}" data-capacity="{{$vehicle->capacity}}" data-status="{{$vehicle->active}}" href="#modal-view">View</a></li>

                    <li><a class="edit" data-toggle="modal" data-name="{{$vehicle->vehiclename_id}}" data-regno="{{$vehicle ->regno}}" data-id="{{$vehicle->id}}" data-capacity="{{$vehicle->capacity}}" href="#modal-form">Update</a></li>
                    <li><a id="{{$vehicle->id}}" class="deactivate">
                    <form id="deactiveform">
                    {{ csrf_field() }}
                    Deactivate
                    </form>
                    </a></li>
                    <li><a id="{{$vehicle->id}}" class="delete">
                    <form id="delform">
                    {{ csrf_field() }}
                    Delete
                    </form>
                    </a></li>
                    
                  </ul>
              </div>

                    </td>
        </tr>
        <?php $i++; ?>
      @endforeach
      </tbody>


    </table>
    </div>
    </div>

@include('includes.footer')



<script type="text/javascript">

  var submit_url;
  var vid;

  $(document).ready(function() {    
    $('.check-error').hide();
    $('#submit').removeAttr('disabled');
     $('#update').removeAttr('disabled');
     $('#title').html('Create Airplane');
     $('#submit').html('Save changes');
     $('#sucessmessage').html('Saving data');
     $("#update").attr("id", "submit");
     $('#errors').html("");

     function displaydata(){
       $.ajax({
                      url     : "{{URL::to('vehicles/showrecord')}}",
                      type    : "GET",
                      async   : false,
                     
                      success : function(s){
                      $('.displayrecord').html(s)
                      }        
       });
       }

      

   $('#add').on("click", function() {
    $("#update").attr("id", "submit");
     $('#submit').removeAttr('disabled');
     $('#title').html('Create Airplane');
     $('#submit').html('Save changes');
     $('#sucessmessage').html('Saving data');     
     $('#vid').val('');
     $('#id').val('');
     $('#regno').val('');
     $('#capacity').val('');
     $('#selname').html("");
     $('#insregno').html("");
     $('#inscapacity').html("");
     $("#form").attr("action", "vehicles/store");
   });

    $("#users").on("click",".edit", function(){
     var id = $(this).data('id');
     var vid = $(this).data('name');
     var regno = $(this).data('regno');
     var capacity = $(this).data('capacity');
    
     var l = window.location;
     var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
     $('#update').removeAttr('disabled');
     $(".modal-body #vid").val(vid);
     $(".modal-body #id").val( id );
     $(".modal-body #regno").val( regno );
     $(".modal-body #capacity").val( capacity );
     

     $('#title').html('Update Airplane');
     $('#submit').html('Update changes');
     $('#sucessmessage').html('Updating data');
     $('#selname').html("");
     $('#insregno').html("");
     $('#inscapacity').html("");
     //$("#submit").attr("id", "update");
     $('.sub-form').remove();
     var r= $('<button type="button" id="update" class="btn btn-primary sub-form">Update changes</button>');
        $("#modal-form .modal-footer").append(r);
      $("#form").attr("action", "vehicles/update");
   });

    $("#users").on("click",".view", function(){
     var name = $(this).data('name');
     var regno = $(this).data('regno');
     var capacity = $(this).data('capacity');
     var status = $(this).data('status');

     var l = window.location;
     var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
     var logo = base_url+'/public/uploads/logo/'+$(this).data('logo');

     $('#update').removeAttr('disabled');
     $(".modal-body .tdname").html(name);
     $(".modal-body .tdlogo").html('<img src="'+logo+'" width="100" height="100" alt="no logo" />');
     $(".modal-body .tdregno").html( regno );
     $(".modal-body .tdcapacity").html( capacity );
     
     if(status == 1){
       $(".modal-body .tdstatus").html('Active');
     }else{
       $(".modal-body .tdstatus").html('Inactive');
     }
   });

 
       $('body').on("click","#submit", function() {
    
     if($('#vid').val() == ""){
        $('#selname').html("Please select airplane name!");
        return false;
     }else if($('#regno').val() == ""){
        $('#insregno').html("Please insert airplane flight number!");
        return false;
     }else if($('#capacity').val() == ""){
        $('#inscapacity').html("Please insert capacity!");
        return false;
     }else{
        $('#submit').attr("disabled", "true");
        var data= false;
        if (window.FormData) {
        data= new FormData();
        }
        var vid = $('#vid').val();
        var regno = $("#regno").val();
        var capacity = $('#capacity').val();
        var token = $("#form input[name=_token]").val();
        var urL = $('#form').attr('action');

        data.append("vid", vid);
        data.append("regno",regno);
        data.append("_token",token);
        data.append("capacity",capacity);
        
        //alert($('input[type=file]')[0].files[0]);

        $.ajax({
                      type: "POST",
                      url: urL,
                      data: data,
                      processData: false,
                      contentType: false,
                      beforeSend: function() { $('#loading').show(); },
                      success: function(response) {
                      //alert(response);return;
                      
                      if(response != 1){
                      $('#errors').html(response);
                      }else if(response == 1){
                      $('#modal-form').fadeOut();
                      $('#loading').hide();
                      $('#update').removeAttr('disabled');
                      $('#vid').val('');
                      $('#regno').val('');
                      $('#capacity').val('');
                      
                      
                      displaydata(); 
                      /*$.alert("Registration Successfully! <br/>A confirmation link has been sent to your email!", {autoClose: true,closeTime: 5000,withTime: false,type: 'success',position: ['center', [-0.25, 0]], title: false,icon:'glyphicon glyphicon-ok',close: '',speed: 'normal',isOnly: true,minTop: 10,animation: false,animShow: 'fadeIn',animHide: 'fadeOut'});*/
                      $.notify({
    // options
    icon: 'glyphicon glyphicon-ok',
    title: 'Airplane',
    message: ' successfully created....',
    url: '',
    target: '_blank'
},{
    // settings
    element: 'body',
    position: null,
    allow_duplicates:false,
    type: "info",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
        from: "top",
        align: "right"
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 3000,
    timer: 1000,
    url_target: '_blank',
    mouse_over: null,
    animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
    },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: 'class',
    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
    '</div>' 
});
                       $('#modal-form').fadeOut();
                      $('body').removeClass('modal-open');
                      $('#loading').hide();
                      
                      }
                     },
                        error: function(xhr,thrownError) {
                       console.log(xhr.statusText);
                       console.log(xhr.responseText);
                       console.log(xhr.thrownError);
                       setTimeout(function(){ 
                       alert("An error occured....Please reload page and try again!!!"); 
                       $('#loading').hide();
                       location.reload();
                       }, 10000);
                        //return false;
                     } 
                     });
     }
   });

       $('body').on("click","#update",function() {
    //alert($('#name').val());
     if($('#vid').val() == ""){
        $('#selname').html("Please select airplane name!");
        return false;
     }else if($('#regno').val() == ""){
        $('#insregno').html("Please insert airplane flight number!");
        return false;
     }else if($('#capacity').val() == ""){
        $('#inscapacity').html("Please insert capacity!");
        return false;
     }else{
        $('#update').attr("disabled", "true");
        var data= false;
        if (window.FormData) {
        data= new FormData();
        }
        var vid = $('#vid').val();
        var id = $('#id').val();
        var regno = $("#regno").val();
        var capacity = $('#capacity').val();
        var token = $("#form input[name=_token]").val();
        var urL = $('#form').attr('action');

        //alert(chair);

        data.append("vid", vid);
        data.append("id", id);
        data.append("regno",regno);
        data.append("_token",token);
        data.append("capacity",capacity);
        //data.append("logo",$('input[type=file]')[0].files[0].name);

        //alert($('input[type=file]')[0].files[0].name);

        $.ajax({
                      type: "POST",
                      url: urL,
                      data: data,
                      processData: false,
                      contentType: false,
                      beforeSend: function() { $('#loading').show(); },
                      success: function(response) {
                      //alert(response);return;
                      
                      if(response != 1){
                      $('#errors').html(response);
                      }else if(response == 1){
                      $('#modal-form').fadeOut();
                      $('#loading').hide();
                      $('#update').removeAttr('disabled');
                      displaydata(); 
                      /*$.alert("Registration Successfully! <br/>A confirmation link has been sent to your email!", {autoClose: true,closeTime: 5000,withTime: false,type: 'success',position: ['center', [-0.25, 0]], title: false,icon:'glyphicon glyphicon-ok',close: '',speed: 'normal',isOnly: true,minTop: 10,animation: false,animShow: 'fadeIn',animHide: 'fadeOut'});*/
                      $.notify({
    // options
    icon: 'glyphicon glyphicon-ok',
    title: 'Airplane',
    message: ' successfully updated....',
    url: '',
    target: '_blank'
},{
    // settings
    element: 'body',
    allow_duplicates:false,
    position: null,
    type: "info",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
        from: "top",
        align: "right"
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 2000,
    timer: 1000,
    url_target: '_blank',
    mouse_over: null,
    animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
    },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: 'class',
    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
    '</div>' 
});
                      $('#modal-form').fadeOut();
                      $('body').removeClass('modal-open');
                      $('#loading').hide();
                      }
                     },
                     error: function(xhr,thrownError) {
                       console.log(xhr.statusText);
                       console.log(xhr.responseText);
                       console.log(xhr.thrownError);
                       setTimeout(function(){ 
                       alert("An error occured....Please reload page and try again!!!"); 
                       $('#loading').hide();
                       location.reload();
                       }, 10000);
                     }
                     });
     }
   });


   $('#vid').on('change', function() {
     if($('#vid').val() == ""){
        $('#selname').html("Please select airplane name!");
        return false;
     }else{
      $('#selname').html("");
     }
   });
  
   $('#regno').keyup(function(){
    if($('#regno').val() == ""){
        $('#insregno').html("Please insert airplane flight number!");
        return false;
     }else{
      $('#insregno').html("");
     }
   });

   $('#capacity').keyup(function(){
    if($('#capacity').val() == ""){
        $('#inscapacity').html("Please insert capacity!");
        return false;
     }else{
      $('#inscapacity').html("");
     }
   });

  });
</script>

<script type="text/javascript">
   $(document).ready(function() {
   $("#users").on("click",".delete", function(){
    
                var id = $(this).attr("id");
                var token = $("#delform input[name=_token]").val();
                //alert(id);
         
                if(confirm("Are you sure you want to delete this airplane?")){
                    $.ajax({
                        type: "POST",
                        url: "{{url('vehicles/delete')}}",
                        data: {id:id,_token:token},
                        success: function(response){
                           //alert(response);
                           if(response == 1){
                            $('.check-error').show();
                            $('.check-error').html("That airplane can`t be deleted because its assigned to a flight number!");
                            setTimeout(function() {
                            $(".check-error").hide('blind', {}, 500)
                            }, 5000);
                          }else{
                            $(".del"+id).fadeOut('slow'); 
                            $.notify({
    // options
    icon: 'glyphicon glyphicon-ok',
    title: 'Airplane',
    message: ' successfully deleted....',
    url: '',
    target: '_blank'
},{
    // settings
    element: 'body',
    position: null,
    type: "info",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
        from: "top",
        align: "right"
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 2000,
    timer: 1000,
    url_target: '_blank',
    mouse_over: null,
    animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
    },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: 'class',
    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
    '</div>' 
});
                        }
                      },
                        error: function(xhr,thrownError) {
                       console.log(xhr.statusText);
                       console.log(xhr.responseText);
                       console.log(xhr.thrownError);
                       setTimeout(function(){ 
                       alert("An error occured....Please reload page and try again!!!"); 
                       $('#loading').hide();
                       location.reload();
                       }, 10000);
                        //return false;
                     } 

                    });
                }else{
                    //return false;
        }
            });   


  $("#users").on("click",".deactivate", function(){
    
                var id = $(this).attr("id");
                var token = $("#deactiveform input[name=_token]").val();
                //alert(id);
         
                if(confirm("Are you sure you want to deactivate this airplane?")){
                    $.ajax({
                        type: "POST",
                        url: "{{url('vehicles/deactivate')}}",
                        data: {id:id,_token:token},
                        success: function(){
                           //alert(response);
                            $(".del"+id).fadeOut('slow'); 
                            $.notify({
    // options
    icon: 'glyphicon glyphicon-ok',
    title: 'Airplanes',
    message: ' successfully deactivated....',
    url: '',
    target: '_blank'
},{
    // settings
    element: 'body',
    position: null,
    type: "info",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
        from: "top",
        align: "right"
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 2000,
    timer: 1000,
    url_target: '_blank',
    mouse_over: null,
    animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
    },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: 'class',
    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
    '</div>' 
});
                        },
                        error: function(xhr,thrownError) {
                       console.log(xhr.statusText);
                       console.log(xhr.responseText);
                       console.log(xhr.thrownError);
                       setTimeout(function(){ 
                       alert("An error occured....Please reload page and try again!!!"); 
                       $('#loading').hide();
                       location.reload();
                       }, 10000);
                        //return false;
                     } 

                    });
                }else{
                    //return false;
        }
            });      
  });
   </script>

@endsection