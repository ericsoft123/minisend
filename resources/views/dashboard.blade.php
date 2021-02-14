<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
  
<!--header-->
@include('components.header.header')
<!--header-->

</head>
<body>
  
<input type="text" class="user_rating">
  <div class="full_screen_image d-none"></div>

  <div class="modal fade" id="modal_formdatasubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title formdata_title" id="exampleModalLabel">Confirm</h5>
        <button type="button" class="mycloses" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <form  id="formdatasubmit">
      <div class="modal-body ">
       
        {{ csrf_field() }}
        <div class="formdatasubmit_append">
       

       </div>
   
        
       
      </div>
      <div class="modal-footer modal_footerappend">
        
     
       
      </div>
      </form>
    </div>
  </div>
</div>
<!--modal form loading-->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <form  id="form_confirm">
        {{ csrf_field() }}
        <div class="confirm_append">
       

       </div>
   
        </form>
        <div class="paymentbtn_append"></div>
       
      </div>
     
        
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" onclick="return reject_btn()">Reject</button>
        <button type="button" class="btn btn-primary" onclick="return confirm_btn()">Confirm</button>
     
      </div>
    </div>
  </div>
</div>
<!--modal form loading-->

    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header ">
        <!-- HEADER MOBILE-->
        @include('components.Menu.topmenu')
        <!-- END HEADER MOBILE-->

        <!--THEME SETTINGS-->   
              <!-- MENU SIDEBAR-->
{{--@include('components.Settings.theme')--}}
       <!-- END MENU SIDEBAR-->    
        <!--THEME SETTINGS-->       
        
        <div class="app-main reset_top_padding">
                      <!-- MENU SIDEBAR-->
       @include('components.Menu.sidemenu')
       <!-- END MENU SIDEBAR-->

                <div class="app-main__outer">
                <div class="container-fluid img-full p-relative">





                      <img width="100%" class="lazyload img-height" data-src="dashboard/assets/images/pharma1.jpg" alt="Card image cap" class="img-height">
                      <div class="banner_fonts p-absolute">
                            <div class="form-group">
                              <h3 class="text-center">Welcome To MedsOnline</h3>
                            </div>
                            <div class="form-group mybtn_banner_class Client d-none">
                            <button type="button" class="btn btn-primary mybutton_banner" onclick="dynamic_menu('Forms_UserMedecine')">Request Medicine Name</button>
                            <button type="button" class="btn btn-success mybutton_banner" onclick="dynamic_menu('Forms_UploadPrescription')">Upload Prescription</button>
                            </div>
                           
                            </div>
                    </div>

                    <!--Accordio-->
                    
  <!--Accordio-->
                    <div class="app-main__inner">
                      <!--top--slider-->
                      
                      <!--top--slider-->

<div class="row">
  <!--My toast Notification-->

  <!--My toast Notification-->
                            <div class="col-md-12">
                            
                                <div class="main-card mb-3 card">
                                    <div class="card-header table_header">
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group d-none">
                                                <button class="active btn btn-focus">Last Week</button>
                                                <button class="btn btn-focus">All Month</button>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="main-card mb-3 card">
                       
                                    <div class="card-body">
                                        <div class="maindiv"></div>
                                        <div id="Table_document" class="formdatas" >
                                       {{--@include('components.Forms.FormUpdate_Profile')--}} 
                                      

                                      

<!-- Modal -->

{{--@include('components.Forms.FormUpdate_Profile')--}}
{{--@include('components.Forms.FormUser_Medecine')--}}
                                      {{-- @include('components.Forms.FormUser_uploadreq')--}} 
                                       {{--@include('components.Table.Table_orders')--}}
                                       
                                   


                                     
                                     



</div>
                                       {{-- @include('components.table.clientlinkeds')--}}


                                        </div> 
    </div>
                                </div>
                            </div>
                        </div>

                    
                    </div>
                    <!--footer-->
                    @include('components.Footer.footer')
                    <!--footer--> 
                
                </div>
              
        </div>
    </div>
      <!--main Content-->
      <!--popup--notification-->
        
  <div class="popup">
    <div class="shadow"></div>
    <div class="inner_popup">
        <div class="notification_dd">
          <ul class="notification_ul">
               

          <li class="poptitle">
            <p class=" mynotification_title"></p>
          <p class="myclose" onclick="return myclose()"><i class="fas fa-times" aria-hidden="true"></i></p>
           
                   
                </li>
               

<div id="main">
         
        <div class="accordion myaccrodion_result" id="faq">

        </div>
        </div>
        
        </ul>
        </div>
    </div>
  </div>

<div class="myaudio_data">
<audio id="failure" src="audio/loose.mp3"></audio>
  
  
</div>
     <!--popup--notification-->

<script>
  
//My global Variable

var audio;
var audio_setting;
var preview_audiodata;
var failure_audio;

var temp_audio;
var temp_audio_setting;
var audio_save_db;
var any_formtrack_open="none_form_open";
var myform="nona_parent_div"+" "+"."+"myform";
var myform_append=any_formtrack_open+" "+"."+" myform_append";
var function_to_run="none_div";
var mainjs="mainjs";
let lat;
let lng;
var search_limit={{env('LIMIT_DISTANCE')}};
var notification=0;
var check_platform="Client";
var platform="";
var myuserid="";
var hashfunction="";
var arr=[];
var temp_total_wdelivery=0;//temp total without delivery

var mynewarray="";
var myproduct_name='';
var inactive_update_profile="0";



//My global Variable

</script>
<!--main Content-->
 <!--footer js-->
 @include('components.Footerjs.footerjs')
 <!--footer js-->
      <div class="mytablejs">

</div>

<div class="mainjs">

</div>


<script>
 
//socket notification

var Appsocket='{{env('APP_LIVE')}}'?'{{env('APP_SKETPRO')}}':'{{env('APP_SKETDEV')}}';
const socket=io(Appsocket);
socket.on("connected_user",data=>{//connected_user is event declared from backend, data is data linked to connected_user on backend
   
 var data_decrypt=atob(data);
    var mydata_parse=JSON.parse(data_decrypt);
    console.log(mydata_parse);
console.log(myuserid);

    if(data==='online')
  {

  }
  else{
//
var data_decrypt=atob(data);
console.log(data_decrypt);
    var mydata_parse=JSON.parse(data_decrypt);
    var users=mydata_parse.userid;
    var UserArr=users.split(',');
    if(UserArr.indexOf(myuserid)!=-1)
    {
      notification++;
      console.log(`My Notification:${notification},Mydata:${mydata_parse.name}`);
      socket_notification_counter();
     socket_alert_dis(mydata_parse.name,mydata_parse.status);
     //document.getElementById('failure').play();



    
    }
    else{
      //console.log(`My Notification:${notification},Mydata:${mydata_parse}`);
    }
//
  }
  
});
function socket_alert_dis(mymessage,status_icon){
  toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
toastr[status_icon](`${mymessage}`);
}
function socket_notification_load(){
    //
    $.ajax({
        //url:`${link}recrutant_application`,
        url:'./notification_counter',
        type:"get",
        //data:$('#contactform').serialize(),
        //dataType:"json",
        success:function(data)
        {
      
      
    if(data.status)
    {
      //play_audio();
    //$('.play_click').click();
    //console.log(notification);
    //console.log(data.result[0].counter);
    
    if(notification!=data.result[0].counter)
    {
      //document.getElementById('failure').play();

   

      $('.notification_counter').text(data.result[0].counter);
      //audio.play();
     // myautoplay();
    
     
     
        notification=data.result[0].counter;
       // console.log("eric");

     
    }
   



    }


  
            
    
        
        } 
      });
    //
  }
function socket_notification_counter(){
    //
    $.ajax({
        //url:`${link}recrutant_application`,
        url:'./notification_counter',
        type:"get",
        //data:$('#contactform').serialize(),
        //dataType:"json",
        success:function(data)
        {
          //$("#failure").prop("muted",false);
          var playPromise = failure.play();
      
if (playPromise !== undefined) {
  playPromise.then(_ => {
    // Automatic playback started!
    // Show playing UI.
  })
  .catch(error => {
    // Auto-play was prevented
    // Show paused UI.
  });
}
      
    if(data.status)
    {
      //play_audio();
    //$('.play_click').click();
    //console.log(notification);
    //console.log(data.result[0].counter);
    
    
      //document.getElementById('failure').play();

      var playPromise = failure.play();
      $("#failure").prop("muted",false);
if (playPromise !== undefined) {
  playPromise.then(_ => {
    // Automatic playback started!
    // Show playing UI.
  })
  .catch(error => {
    // Auto-play was prevented
    // Show paused UI.
  });
}


      $('.notification_counter').text(data.result[0].counter);
      //audio.play();
     // myautoplay();
    
     
     
        notification=data.result[0].counter;
       // console.log("eric");

     
    
   



    }


  
            
    
        
        } 
      });
    //
  }
//

/*$(function(){
$('.clientedatas').modal('show');
table_clientdatas();

});*/

$(function(){
    
 
    get_profile_detail();
    socket_notification_load();
  
    
               
           });
function openmodal(modalclass){
   // $('.'+modalclass).modal('show');
  // console.log(modalclass);
   $('.'+modalclass).modal('show');
}
</script>

<script>

var htmlform="template/forms";
var htmljs="template/js";
//var token_value=$('#token_value').val();
var token_value='{{ csrf_token() }}';
//console.log(token_value);
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
/*menu */
function menu_display(){
  console.log(window.location.hash);

}
/*$(function(){
 
  var get_hash=window.location.hash;
  if(get_hash!='')
  {
    var menudata=get_hash.replace(/#/ig, "menu_");
  //console.log(menu);
  //window["func_"+function_name]();
  window[`${menudata}`]();
  //window.menu_create_doc = new Function();
  }
 
});*/

$(function(){
 // 
  menu_navigate();

});

function menu_navigate(){
  var get_hash=window.location.hash;
  ///console.log("hello");

  if(get_hash!='')
  {
     var hashdata=get_hash.replace(/#/ig,"");
     

    if(hashdata.length>2){
      dynamic_menu(hashdata);
    }


} 
else{
  hashdata="Forms_Home";
  dynamic_menu(hashdata);
}

if(checkscreen()) {
  $('.body-tabs-shadow').addClass('closed-sidebar-mobile closed-sidebar');
  $('.mobile-toggle-nav').addClass('mymobile-toggle-nav');
  $('.show_mobile_only').removeClass('d-none');
}

}
function checkscreen(){
  if($(window).width() < 985) {
  return true;
}
}
function menu_open()
{
 // console.log("open");
  
  $('.closed-sidebar-mobile').toggleClass('sidebar-mobile-open');
  $('.mymobile-toggle-nav').toggleClass('is-active');
  //if($('.mobile-toggle-nav').hasClass('.is-active'))
}
function dynamic_menu(hashdata){
  //console.log(platform);
  
  hashfunction=hashdata;
  console.log(`my hash function ${hashfunction}`);
if($('.visible_div').hasClass(hashdata))
{
  //use_location();
  
  /*get_profile_detail();
search_address_profile();*/
//Myhashmethod[hashfunction]();



 // console.log("no find from server execute function");
$('.visible_div').addClass('d-none');
$('.'+hashdata).removeClass('d-none');

//
if(typeof(mainmethod[hashdata])=="function")
{
  mainmethod[hashdata]();
  
}
else{
  
 
}
//
}
else{
//
var locationfolder=hashdata.split('_')[0];
  //
  $.ajax({
//url:"./test_getformdata",
url:"./get_componentblade",//user get data
data:{locationfolder:locationfolder,hashdata:hashdata},
type:"get",

success:function(data){
  /*  $('.formdatas').first().hide();
$('.maindiv').html(`${data.divdata}`);

$('.mainjs').html(`${data.javascriptdata}`);*/
if(data.status)
{
  
  $('.visible_div').addClass('d-none');
$('.maindiv').prepend(`${data.divdata}`);

/*get_profile_detail();
search_address_profile();*/
//Myhashmethod[hashfunction]();
initAutocomplete();
$('.mainjs').html(`${data.javascriptdata}`);


if(typeof(mainmethod[hashdata])=="function")
{
  mainmethod[hashdata]();
  initAutocomplete();
}
else{
  
 
}
$('.visible_div').first().addClass(hashdata);//add class to first div as their hash
platform=data.platform;
myuserid=data.userid;
$('.'+data.platform).removeClass('d-none');

}
else{
  //login expired then return to login by checking first which platform
}
}
});
//

}
if(checkscreen()){//this is to close menu on click
  menu_open();
}
//
}

function use_location(){
  var ishidden=hashfunction==='Forms_UpdateProfile'?'d-none':'';
  $('.formdata_title').text("Do you Want to");
$('#modal_formdatasubmit').modal('show');
$('.formdatasubmit_append').html(`
<div class="form-check d-none">
  <input class="form-check-input" type="radio" name="exampleRadios" value="" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
   Profile Address
  </label>
</div>

<div class="form-check ${ishidden}">
  <input class="form-check-input" type="radio" name="exampleRadios" value="" id="defaultCheck1" onclick="return change_address()">
  <label class="form-check-label" for="defaultCheck1">
  Change address
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" value="" id="defaultCheck1" onclick="return usecurrent()">
  <label class="form-check-label" for="defaultCheck1">
  Use Current Address
  </label>
</div>
`);

}
function change_address(){

  //console.log("tedt");
  $('#modal_formdatasubmit').modal('hide');
  $('.address_show').removeClass('d-none');
}
function usecurrent()
{
  $('#modal_formdatasubmit').modal('hide');
  get_location();
  setTimeout(() => {
  search_address_profile();
}, 1000);
 
   
  
}




</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!--location address and Latitude-->
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSHiuycP-Ea9cdFKdfpGs0coDv2WjKAlw&libraries=places&callback=initAutocomplete"
        ></script>
      
        
        <script>
      	
         

           //start function search_product
           function search_product(thisdata){
            var name=thisdata.value;
    //
    $.ajax({
        //url:`${link}recrutant_application`,
        url:'./search_product',
        type:"get",
        data:{
         name:name,
        },
        //data:$('#contactform').serialize(),
        //dataType:"json",
        success:function(data)
        {
      
      
    if(data.status)
    {
      var data=data.result;
      var getdata="";
     for(var i=0;i<data.length;i++)
     {
       getdata+=`<div class="form-control bg-white border-radius-0" onclick="choose_search_medecine('${data[i].med_prop_name}','${data[i].nappi_code}')">${data[i].med_prop_name}</div>`;
     }
     $('.search_append').html(getdata);
    }


  
            
    
        
        } 
      });
    //
  }
  $(document).click(function() {
    $('.search_append').html("");
});
function choose_search_medecine(med,nappi_code)
{
  /*$('#search_medecine').val(med);
  $('#nappi_code').val(nappi_code);
  $('.search_append').html("");*/
 /*if(arr.findIndex(myindexdata =>myindexdata.nappi_code === napicode)!=-1)//-1 result not found
 {

 }
 else{
   alert("this Medecine already exist please choose another one");
 }*/
 $('#search_medecine').val("");
 $('#search_medecine').attr("Placeholder","Add New Medecine");
 
 /*$('.med_append').prepend(`<div class="${nappi_code}">
 <div class="form-group">
<label for="">Medecine Name</label>
  <input type="text" class="form-control" readonly value="${med}"><button class="btn btn-danger" onclick="return remove_product_name(${nappi_code})">X</button>
  </div>

  <div class="form-group">
  <label for="">Quantity</label>
  <input type="number" class="form-control" value="0" name="qty[]" onchange="return qty(this,'${nappi_code}')" onkeyup="return qty(this,'${nappi_code}')">
  </div>
 </div>`);*/
 $('.list-medecine').remove();
 $('.med_append').prepend(`
 <button type="button" class="list-group-item list-group-item-action active list-medecine">
  List of Medecine
  </button>
 <li class="list-group-item d-flex justify-content-between align-items-center ${nappi_code}">
 ${med}
    <span class="badge badge-pill"><input type="number" placeholder="qty" class="form-qty" value="1" name="qty[]" onchange="return qty(this,'${nappi_code}')" onkeyup="return qty(this,'${nappi_code}')"><button class="btn btn-danger btn-qty" onclick="return remove_product_name(${nappi_code})">X</button></span>
  </li>
 `);
 

 


//console.log(indexdata);
var item={};//object
  item["med_name"]=med;
item["nappi_code"]=nappi_code;
item["qty"]="1";
item["price"]="0";
arr.push(item);
 console.log(arr);

  



 $('.mymedecine').val(JSON.stringify(arr));
 //console.log(arr);

}
function qty(thisdata,napicode){
  if(thisdata.value==="") return console.log("empty data"); else if(thisdata.value<1) return alert("Please type valid qty number");
  console.log(`my value:${thisdata.value}; my Napicode:${napicode}`);
  var myarray=JSON.parse(JSON.stringify(arr));
  var indexdata=myarray.findIndex(x => x.nappi_code ===napicode);;
 console.log(indexdata);
 //myarray[indexdata].qty=thisdata.value;
// myarray[indexdata].qty="eric";
 myarray[indexdata].qty=thisdata.value;
 
  $('.mymedecine').val(JSON.stringify(myarray));
  arr=myarray;
  console.log(arr);
}
function remove_product_name(napicode)
{
  arr.splice(arr.findIndex(myindexdata =>myindexdata.nappi_code === napicode), 1);
  
  $('.mymedecine').val(JSON.stringify(arr));
  $('.'+napicode).remove();
  if(arr.length<=0)
  {
    $('#search_medecine').val("");
  }
  
}
           //End function search_product
  //focus data

  //focus data
//start search pharmacie nearyby//
function presearch_limit(thisdata)
{
  search_limit=thisdata.value;
 search_address_profile();
}
function medsearch_limit(thisdata)
{
  console.log(lat);
 search_limit=thisdata.value;
 search_address_profile();
}
function search_address_profile(){
 
            $.ajax({
        //url:`${link}recrutant_application`,
        url:'./search_address_profile',
        type:"get",
        data:{
          mylat:lat,
          mylng:lng,
          search_limit:search_limit,

        },
        //data:$('#contactform').serialize(),
        //dataType:"json",
        success:function(data)
        {
      if(data.status)//true result is available
      {
 //console.log(data.response);
 var data = data.result;
 //console.log(Object.keys(data[0]));
 //console.log(Object.values(data[0]));
var getdata='';
for(var i=0;i<data.length;i++)
{
console.log(Object.keys(data[i]));
var name_field=Object.keys(data[i]);
var name_field_value=Object.values(data[i]);
console.log(name_field[i]);
for(var j=0;j<name_field.length;j++)
{
  getdata+=`
<div class="form-group">
<input type="text" class="form-control" name="${name_field[j]}[]" value="${name_field_value[j]}">
</div>

`;
}



}
$('.append_div').html(getdata);
$('.error_message').text("");
      }
      else{
      
        $('.'+data.error_message_selector).text("Sorry we can not find Pharmacie around you,please change Address or change Area");
       $('.change_area').removeClass('d-none');
        $('.append_div').html('');
      
      }
     
  
            
    
        
        } 
      });
           }
//start search pharmacie nearyby//
           //start profile funct

function save_audiofile()
{
  if(confirm("Are you Sure Do you want want to save this Settings"))
    {
      audio_save_setting();
    }        

}
function  audio_save_setting(){
  var myaudio_save=JSON.stringify(temp_audio_setting);
  $.ajax({
      
      url:'./change_audio_profile',
      type:"post",
     data:{
    audio:temp_audio,
    audio_save_db:myaudio_save,
   "_token":'{{ csrf_token() }}',
     },
      success:function(data)
      {
    
    
  if(data.status)
  {
   

    Swal.fire({
  title: '',
  text: "Your Settings has been updated",
  icon: 'success',
  
  
}).then((result) => {
  $("#failure").prop("muted",temp_audio_setting.muted);
  var myvolume=temp_audio_setting.audio_volume/100;
  $("#failure").prop("volume",myvolume);

})




  }



          
  
      
      } 
    });
}
function preview_audio(){
  document.getElementById('preview_audio').play();
}
function muted_myaudio()
{
 // var mycolor_btn=temp_audio_setting.muted===true?'btn-danger':'';
  
  var mymuted=temp_audio_setting.muted===true?false:true;
  $("#preview_audio").prop("muted",mymuted);
  if(!mymuted)
  {
    $('.myaudio_btn').addClass('btn-danger');
  }
  else{
    $('.myaudio_btn').removeClass('btn-danger');
  }
 
  temp_audio_setting.muted=mymuted;
 

 

 

}
function get_audiodata(thisdata)
{
  //console.log(thisdata.files[0]);
  var file=thisdata.files[0];
 
  getBase64(file);


}
function getBase64(file) {
   var reader = new FileReader();
   reader.readAsDataURL(file);
   reader.onload = function () {
     //console.log(reader.result);

     $('.preview_audio').html(`<audio id="preview_audio" src="${reader.result}"></audio>`);
     temp_audio=reader.result;
   };
   reader.onerror = function (error) {
     console.log('Error: ', error);
   };
}

function audio_adjust_volume(thisdata){
  var slider = document.getElementById("myaudio_volume");
//console.log(thisdata.value);

  temp_audio_setting.audio_volume=thisdata.value;
  var myvolume=temp_audio_setting.audio_volume/100;
  $("#preview_audio").prop("volume",myvolume);


}
function audio_setting(myaudio,myaudio_setting){

var mjsonAudio=JSON.parse(myaudio_setting);
temp_audio=myaudio;
temp_audio_setting=mjsonAudio;
//audio_save_db=myaudio_setting;
 
       
      $('.myaudio_data').html(`
<audio id="failure" src="${myaudio}"></audio>
  `);
      $('.preview_audio').html(`<audio id="preview_audio" src="${myaudio}"></audio>`);
     
      
  
var myvolume=mjsonAudio.audio_volume/100;
        $("#preview_audio").prop("muted",mjsonAudio.muted);
        $("#preview_audio").prop("volume",myvolume);
        $('#myaudio_volume').val(mjsonAudio.audio_volume);
         
        $("#failure").prop("muted",mjsonAudio.muted);
        $("#failure").prop("volume",myvolume);
var mycolor_btn=mjsonAudio.muted===true?'btn-danger':'';
$('.myaudio_btn').toggleClass(mycolor_btn);
if(!mjsonAudio.muted)
  {
    $('.myaudio_btn').addClass('btn-danger');
  }
  else{
    $('.myaudio_btn').removeClass('btn-danger');
  }
    
           }

          
       function admin_inactive_profile_detail(){

       }
           function get_profile_detail(){
             
            $.ajax({
        //url:`${link}recrutant_application`,
        url:'./get_profile_detail',
        type:"get",
        //data:$('#contactform').serialize(),
        //dataType:"json",
        success:function(data)
        {
          
      //console.log(data.response);
      var obj = data.response;

Object.keys(obj).forEach(function(key) {
   // console.log(key, obj[key]);
    //console.log(key);
    $('.'+key).val(obj[key]==='none'?'':obj[key]);
    $('.'+key).text(obj[key]);
});


/*Script to show and hide specific menu*/
//console.log(data.response.platform_menu);
//console.log(data.response.platform_menu.platform);//status of client

audio_setting(data.response.audio,data.response.audio_setting);
$('.'+data.response.platform_menu.platform).removeClass(data.response.platform_menu.menu_hide);
lat=data.response.lat;

lng=data.response.lng;
if(data.response.platform==='{{env('Unverified')}}')
{
  Swal.fire({
  title: '',
  text: "You are unverified ,please click Ok to go to verification process or contact us",
  icon: 'error',
  
 	
  					
}).then((result) => {
 // console.log("true");
 //get_chatrequest_order();
 window.location.href ='unverified';
 //window.location.href ='logout';
})

}
else if(data.response.platform==='{{env('isInactive')}}')
{

  if((data.response.lat!='none'))
  {
    Swal.fire({
  title: '',
  text: "Membership pending please Contact Admin",
  icon: 'error',
  
  
}).then((result) => {
 // console.log("true");
 //get_chatrequest_order();
 window.location.href = "logout";
})
  }
  else{
    //window.location.href="./profile#Forms_updateProfile";
      //hashdata="Forms_updateProfile";
      //dynamic_menu(hashdata);
      //dynamic_menu(hashdata);
      //dynamic_menu('Forms_UpdateProfile');
      if(inactive_update_profile==="0"){
        //$('#clientdata').click();
        
        inactive_update_profile=1;
        dynamic_menu('Forms_UpdateProfile');
    Swal.fire({
  title: '',
  text: "Please Update your Profile",
  icon: 'error',
  
  
}).then((result) => {
 // console.log("true");
 //get_chatrequest_order();
 
 
})
      }
     else{

     }
    
      //dynamic_menu(hashdata)
   //   $('#clientdata').click();
  }
 

}

else if(data.response.platform==='{{env('Client')}}')
{
  flatpickr('.dob',{
   
    
   dateFormat: "Y-m-d",
 
   //defaultDate: [start_time, end_time]
});

if(data.response.lat==='none'){//to force users to update profile First before requesting medecine
  $('.tel').val("");
  //$myemail=$('.email').val();
  var regex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
  regex.test(data.response.email)?'':$('.email').val("");//validate email
  var my_hash=window.location.hash;
  console.log("profile");

     var hashname=my_hash.replace(/#/ig,"");
     if(hashname!='Forms_updateProfile')
     {
      alert("Please update Profile first");
      window.location.href="./profile#Forms_updateProfile";
      hashdata="Forms_updateProfile";
      //dynamic_menu(hashdata)
      $('#clientdata').click();
$('.tel').val("");
$('.dob').val("");
/*$('.lat').val("-29.8557187");
$('.lng').val("-29.8557187");*/
$('#tel').val("");

     }
 
}
else{
  
  flatpickr('.dob',{
   
    
   dateFormat: "Y-m-d",
 
   //defaultDate: [start_time, end_time]
});
}
}
else if(data.response.platform==='{{env('Standard')}}')
{
  flatpickr('.dob',{
   
    
   dateFormat: "Y-m-d",
 
   //defaultDate: [start_time, end_time]
});
if(data.response.lat==='none'){//to force users to update profile First before requesting medecine
  var my_hash=window.location.hash;
  console.log("profile");

     var hashname=my_hash.replace(/#/ig,"");
     if(hashname!='Forms_updateProfile')
     {
      alert("Please update Profile first");
      window.location.href="./profile#Forms_updateProfile";
      hashdata="Forms_updateProfile";
      //dynamic_menu(hashdata)
      $('#clientdata').click();
$('.tel').val("");
$('.dob').val("");
/*$('.lat').val("-29.8557187");
$('.lng').val("-29.8557187");*/
$('#tel').val("");

     }
 
}
else{
  
  flatpickr('.dob',{
   
    
   dateFormat: "Y-m-d",
 
   //defaultDate: [start_time, end_time]
});
}
}
else if(data.response.platform==="Banned"){
  //
  Swal.fire({
  title: 'You are Banned',
  text: "Please chat with system Admin for More",
  icon: 'error',
  
  
}).then((result) => {
 // console.log("true");
 //get_chatrequest_order();
 window.location.href = "logout";
})
  //

}
 /*Script to show and hide specific menu*/
   /*if(confirm("Do you want to use your current location?"))
    {
      get_location();
    }  */       

  
            
    
        
        } 
      });
           }
           //end profile funct

           
                   
         
           
                   //new code
           //geocode
           // This example displays an address form, using the autocomplete feature
                 // of the Google Places API to help users fill in the information.
           
                 // This example requires the Places library. Include the libraries=places
                 // parameter when you first load the API. For example:
                 // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
           
                 var placeSearch, autocomplete;
                 var componentForm = {
                   street_number: 'short_name',
                   route: 'long_name',
                   locality: 'long_name',
                   administrative_area_level_1: 'short_name',
                   country: 'long_name',
                   postal_code: 'short_name'
                 };
           
                 function initAutocomplete() {
                   // Create the autocomplete object, restricting the search to geographical
                   // location types.
                   autocomplete = new google.maps.places.Autocomplete(
                       /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                       {types: ['geocode']});
           
                   // When the user selects an address from the dropdown, populate the address
                   // fields in the form.
                   autocomplete.addListener('place_changed', fillInAddress);
                 }
           
                 function fillInAddress() {
                   // Get the place details from the autocomplete object.
                   var place = autocomplete.getPlace();
                   console.log(`${place.geometry.location.lat()} and long: ${place.geometry.location.lng()}`);
           $('#lat').val(place.geometry.location.lat());
           $('#lng').val(place.geometry.location.lng());
           lat=place.geometry.location.lat();
           lng=place.geometry.location.lng();
           search_address_profile();
                   for (var component in componentForm) {
                       console.log(component);
                    // document.getElementById(component).value = '';
                     //document.getElementById(component).disabled = false;
                   }
           
                   // Get each component of the address from the place details
                   // and fill the corresponding field on the form.
                   for (var i = 0; i < place.address_components.length; i++) {
                     var addressType = place.address_components[i].types[0];
                     if (componentForm[addressType]) {
                       var val = place.address_components[i][componentForm[addressType]];
                      // document.getElementById(addressType).value = val;
                     
                     }
                   }
                 }
           
                 // Bias the autocomplete object to the user's geographical location,
                 // as supplied by the browser's 'navigator.geolocation' object.
                 function geolocate() {
                   console.log("gelocate");
                   if (navigator.geolocation) {
                     navigator.geolocation.getCurrentPosition(function(position) {
                       var geolocation = {
                         lat: position.coords.latitude,
                         lng: position.coords.longitude
                       };
                       var circle = new google.maps.Circle({
                         center: geolocation,
                         radius: position.coords.accuracy
                       });
                       autocomplete.setBounds(circle.getBounds());
                     });
                   }
           
                 }
           //geocode
                   
                 
           
                   function get_location(){
               ////
               
               
                var currgeocoder;
           
                    //Set geo location lat and long
           
                    navigator.geolocation.getCurrentPosition(function(position, html5Error) {
           
                        geo_loc = processGeolocationResult(position);
                        currLatLong = geo_loc.split(",");
                        initializeCurrent(currLatLong[0], currLatLong[1]);
           
                   });
           
                   //Get geo location result
           
                  function processGeolocationResult(position) {
                        html5Lat = position.coords.latitude; //Get latitude
                        html5Lon = position.coords.longitude; //Get longitude
                        html5TimeStamp = position.timestamp; //Get timestamp
                        html5Accuracy = position.coords.accuracy; //Get accuracy in meters
                        return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
                  }
           
                   //Check value is present or not & call google api function
           
                   function initializeCurrent(latcurr, longcurr) {
                        currgeocoder = new google.maps.Geocoder();
                        console.log(latcurr + "-- ######## --" + longcurr);
           $('#lat').val(latcurr);
           $('#lng').val(longcurr);
           lat=latcurr;
           lng=longcurr;
                        if (latcurr != '' && longcurr != '') {
                            var myLatlng = new google.maps.LatLng(latcurr, longcurr);
                            return getCurrentAddress(myLatlng);
                        }
                  }
           
                   //Get current address
           
                    function getCurrentAddress(location) {
                         currgeocoder.geocode({
                             'location': location
           
                       }, function(results, status) {
                      
                           if (status == google.maps.GeocoderStatus.OK) {
                               var data=results[0].address_components;
                               console.log(data);
                               //console.log(`${data[0].long_name},${data[1].long_name}`);
                               var f_address="";
                               for(var i=0;i<data.length;i++)
                               {
                                   f_address+=`${data[i].long_name},`;
                               }
                             
                              $(".location_address").val(f_address);
                              //$(".location_address").val(results[0].formatted_address);
                           } else {
                               alert('Geocode was not successful for the following reason: ' + status);
                           }
                       });
                    }
               
               
               
               
               ////
           }
           
          
                  
                   </script>
<!--location address and Latitude-->
<!--notification and Popup-->

<script>
//notification
  //nofification counter
  function confirm_btn(){
    $('#confirm_status').val('accepted');
$('.submit_btn').click();
  }
  function reject_btn(){
    if(confirm("Are you sure you want to Reject This Request"))
    {
      $('#confirm_status').val('rejected');
      $('.submit_btn').click();
    }
  }
  $('#form_confirm').submit(function(ev){
   if(check_platform==='Client')
   {
    client_request();
   
   }
   else{
    admin_request();
    
   }
    
    ev.preventDefault();
});

  function admin_request(){
    //
    $.ajax({

url:`./pharm_statuschange_request`,
type:'post',
data:$('#form_confirm').serialize(),
success:function(data){
if(data.status){//return data as true
   
     //alert("query has executed successfuly");
     Swal.fire({
  title: '',
  text: "quotation successfully submitted",
  icon: 'success',
  
  
}).then((result) => {
  window.location.href="./profile";
  console.log("true");
}) 
   
   
}
else{
   
}



},
error:function(data){
//alert("errors occured please retry this process again or contact system Admin");
//window.location.href = "./login";
}
});
    //
  }

  function client_request(){
    //
    $.ajax({

url:`./client_statuschange_request`,
type:'post',
data:$('#form_confirm').serialize(),
success:function(data){

$('.paymentbtn_append').html(data);

/*if(data.status){//return data as true
   
     //alert("query has executed successfuly");
     
 if(data.payment)
 {
  Swal.fire({
  title: '',
  text: "You will be redirected to payment portal",
  icon: 'success',
  
  
}).then((result) => {
  console.log("true");
})

 }
 else{
   //alert("Your Query has been executed successfuly");
 //
 Swal.fire({
  title: '',
  text: "successfuly Submitted expect a response soon",
  icon: 'success',
  
  
}).then((result) => {
  console.log("true");
}) 
 //
 
 
 }



}
else{
   
}*/



},
error:function(data){
//alert("errors occured please retry this process again or contact system Admin");
//window.location.href = "./login";
}
});
    //
  }
  function confirmed(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,product_name,phone,phone2){
    $('#confirmModal').modal("show");
  }
  function reject_admin(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,product_name,phone,phone2){
    view_admin(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,product_name,phone,phone2);
    reject_btn();
  
  }
  function accept_admin(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,phone,phone2,product_name,delivering_time,total_pricing,address,user_delivery_choice){
    //$('#confirmModal').modal("show");
    view_admin(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,phone,phone2,product_name,delivering_time,total_pricing,address,user_delivery_choice);
   
    
  }
  function view_admin(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,phone,phone2,product_name,delivering_time,total_pricing,address,user_delivery_choice){
    $('#confirmModal').modal("show");
    //
   
   //console.log(JSON.parse(data.result[0].product_name));
   
 var productname=atob(product_name);
    myproduct_name=productname==='none'?'':JSON.parse(productname);
    //myproduct_name=JSON.parse(productname);
 
   var myproduct="";
   for(var i=0; i<myproduct_name.length;i++)
   {
     myproduct+=`<div class="form-group">
   
<label for="">Medecine Name</label>
<input type="text" class="form-control" value="${myproduct_name[i].med_name}" readonly>
</div>

<label for="">Qty</label>
<input type="text" class="form-control" value="${myproduct_name[i].qty}" readonly>
</div>

<label for="">Price</label>
<input type="text" class="form-control" name="pricing" onkeyup="return keyadd_pricing(${[i]},this)"  required>
</div>

`
   }
   var price_prescr=`<label for="">Price</label>
<input type="text" class="form-control" name="pricing" onkeyup="return keyadd_pricing('none',this)"  required>
</div>`;
   myproduct=productname==='none'?price_prescr:myproduct;

   //
   var collection_env='{{env('ORDER_OPTION1')}}';//collection
  var is_delivery_hide=atob(user_delivery_choice)===collection_env?'d-none':'';

var show_hideimg=atob(img_url)==='none'?'d-none':''; 
 var show_hidename=product_name==='none'?'d-none':''; 
 var show_hidephone2=phone2==='none'?'d-none':''; 
 var show_hidedescription=description==='none'?'d-none':''; 
var envpay1='{{env('PAY_DELIVERY')}}';
var envpay2='{{env('PAY_ONLINE')}}';

var multipayment_choice=`<label for="" class="choose_pay_mode">Choose Payment options</label>
       
       <div class="append_btn">
 
 <button class="btn btn-success" onclick="choose(this)"  value='${envpay2}'><input type="checkbox"> ${envpay2}</button>       <button  class="btn btn-success" onclick="choose(this)"  value='${envpay1}'><input type="checkbox"> ${envpay1}</button>
</div>
<div class="form-group">
<label class="added_pay_mode d-none">Added Payment</label>
<div class="append_tag">

</div>
</div>`;

var payment_collection=`<label for="">Client order Choice</label>
<input type="text" name="pay_mode[]" class="form-control" value="${collection_env}" readonly>`;//collection

var payment_Delivery=`<label for="">Client order Choice</label>
<input type="text" name="pay_mode[]" class="form-control" value="Delivery" readonly>`;//collection
//var is_payment_hide=atob(user_delivery_choice)===collection_env?payment_collection:multipayment_choice;//before
var is_payment_hide=atob(user_delivery_choice)===collection_env?payment_collection:payment_Delivery;//before

$('.confirm_append').html(`<input type="hidden" id="confirm_status" name="status" value="${status}">
<input type="hidden" name="uid" value="${uid}">
<div class="form-group">
<label for="">Client Address</label>
<input type="text" class="form-control" value="${atob(address)}" readonly>
</div>
<div class="form-group">
     ${is_payment_hide}


       </div>
${myproduct}
<input name="product_name" type="hidden"  class="form-control myproduct_name"   readonly>
<div class="form-group ${is_delivery_hide}">
<label>Delivery time</label>
<input type="text" id="delivering_time" class="form-control delivering_time" name="delivering_time" readonly required>
</div>
<input type="hidden" name="mydata_userid" value="${userid}">
<div class="form-group ${is_delivery_hide}">
        <label for="">Delivery Cost</label>
         <input type="text" class="form-control pricing_delivery" name="pricing_delivery" value="0" onkeyup="delivery(this)">
       </div>
       <div class="form-group tot_append">
       </div>

       
    
<div class="form-group">
<label for="">Client Contact no</label>
<input type="text" class="form-control" value="${phone}" readonly>
</div>
<div class="form-group ${show_hidephone2}">
<label for="">Client Alternative Contact no</label>
<input type="text" class="form-control" value="${phone2}" readonly>
</div>
<a href="#" class="btn btn-primary ${show_hideimg}" onclick="return view_image('${atob(img_url)}')">View Image</a>
<img src="upload/${atob(img_url)}" class="img-fluid d-none myimage" alt="Responsive image">
      




       <div class="form-group ${show_hidedescription}">
        <label for="">Client Comment</label>
       <textarea name="comment" class="form-control" cols="10" rows="2" readonly>${atob(description)}</textarea>
       </div>
       <div class="form-group">
        <label for="">Enter Some Comment</label>
       <textarea name="uid_message" class="form-control" cols="30" rows="2"></textarea>
       </div>
       <input type="submit" name="submit" class="submit_btn d-none" value="submit"> `);
//
         
//
flatpickr('#delivering_time',{


enableTime: true,

minDate: "today",
dateFormat: "Y-m-d H:i:s",
time_24hr: true
//defaultDate: [start_time, end_time]
});


 
     
   
 //
   
  }

function delivery(thisdata){
if($('.tot_append input').hasClass('mytotal'))
{
  if(thisdata.value==='')
  {
    

  }
  else{
   
    
    var sum=parseInt(temp_total_wdelivery)+parseInt(thisdata.value);
    $('.mytotal').val(sum);
   
    console.log(sum);

  }
}
}
function keyadd_pricing(myindex,thisdata)
{
  //console.log(thisdata.value);
//console.log(myproduct_name[myindex].qty);
if(myindex==='none')//it means that it is prescriptionpicture
{
  var sum =0;
  var delivery=$('.pricing_delivery').val();
  sum+=parseInt(thisdata.value);
//console.log(sum);
temp_total_wdelivery=sum;
var total=sum+parseInt(delivery);
$('.myproduct_name').val("none");
$('.tot_append').html(`
<label for="">Total</label>
<input name="total"  class="form-control mytotal"  value="${total}" readonly>`);

}
else{
//
myproduct_name[myindex].price=thisdata.value;
//console.log(JSON.stringify(myproduct_name));
var sum =0;
for(var i=0;i<myproduct_name.length;i++)
{
  sum+=parseInt(myproduct_name[i].price*myproduct_name[i].qty);
}
var delivery=$('.pricing_delivery').val();
console.log(sum);
temp_total_wdelivery=sum;
var total=sum+parseInt(delivery);
$('.myproduct_name').val(JSON.stringify(myproduct_name));
$('.tot_append').html(`
<label for="">Total</label>
<input name="total"  class="form-control mytotal"  value="${total}" readonly>`);
temp_total=total;
//
}


}
  //client code
  function reject_client(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,phone,phone2,product_name,delivering_time,total_pricing,address,user_delivery_choice){
    view_client(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,phone,phone2,product_name,delivering_time,total_pricing,address,user_delivery_choice);
    reject_btn();
  
  }
  function accept_client(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,phone,phone2,product_name,delivering_time,total_pricing,address,user_delivery_choice){
    if(total_pricing==='none')
    {
      Swal.fire({
  title: '',
  text: "Please wait Response for this Request",
  icon: 'error',
  
 	
  					
});
    }
    else{
      $('#confirmModal').modal("show");
    view_client(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,phone,phone2,product_name,delivering_time,total_pricing,address,user_delivery_choice);
    }
   
  //
  }
  function view_client(uid,userid,status,uid_provider,pricing,pricing_delivery,pay_mode,ui_message,img_url,description,product_id,phone,phone2,product_name,delivering_time,total_pricing,address,user_delivery_choice){
  //
 
 
  //console.log(JSON.parse(data.result[0].product_name));
  var productName=atob(product_name);
   myproduct_name=productName==='none'?'':JSON.parse(productName);
  
   var myproduct=`<div class="${show_hidename}">`;
   for(var i=0; i<myproduct_name.length;i++)
   {
     myproduct+=`
     <div class="form-group">
   
<label for="">Medecine Name Requested</label>
<input type="text" class="form-control" value="${myproduct_name[i].med_name}" readonly>
</div>

<label for="">Qty</label>
<input type="text" class="form-control" value="${myproduct_name[i].qty}" readonly>
</div>

<label for="">Price</label>
<input type="text" class="form-control" name="pricing" value="${myproduct_name[i].price}"  required readonly>
</div>

`
   }
   myproduct+=`</div>`;
   myproduct=productName==='none'?'':myproduct;
   var show_hideuimessage=atob(ui_message)==='none'?'d-none':'';
var show_hidepricing_delivery=pricing_delivery==='0'?'d-none':'';
var mytype1='{{env('type1')}}';
var mytype2='{{env('type2')}}';
var show_hideimg=atob(img_url)==='none'?'d-none':''; 
var is_deliverytime_hide=atob(delivering_time)==='none'?'d-none':'';
 var show_hidename=productName==='none'?'d-none':''; 
 var type_order=atob(img_url)==='none'?mytype1:mytype2; 
 var paymode=pay_mode.split(',');
 
pay_mode='<select name="pay_mode" class="form-control">';
for(var i=0;i<paymode.length;i++)
{
pay_mode+=`<option selected>${paymode[i]}</option>`
}
pay_mode+="</select>";
pay_mode=pay_mode;
console.log(pay_mode);

$('.confirm_append').html(`<input type="hidden" id="confirm_status" name="status" value="${status}">
<input type="hidden" name="uid" value="${uid}">
<input type="hidden" name="mydata_userid" value="${userid}">
<input type="hidden" name="uid_provider" value="${uid_provider}">


<div class="form-group d-none">
<label for="">Medecine Requested</label>
<input type="text" class="form-control client_productname" name="product_name" >
<input type="hidden" class="form-control" name="product_uid" value="${product_id}">
</div>
<div class="form-group d-none">
<label for="">Client Number</label>
<input type="text" class="form-control" name="phone1" value="${phone}">
</div>
<div class="form-group d-none">
<label for="">Client Number 2</label>
<input type="text" class="form-control" name="phone2" value="${phone2}">
</div>

<a href="#" class="btn btn-primary ${show_hideimg}" onclick="return view_image('${atob(img_url)}')">View My Prescription</a>
<input type="hidden" id="prescr_imgurl" name="prescr_imgurl" value="${atob(img_url)}">
<input type="hidden" id="type_order" name="type_order" value="${type_order}"/>
<img src="upload/${atob(img_url)}" class="img-fluid d-none myimage" alt="Responsive image">
<div class="form-group ${is_deliverytime_hide}">
<label>Delivery time</label>
<input type="text" class="form-control delivering_time" value="${atob(delivering_time)}" name="delivering_time" readonly required>
</div>
       ${myproduct}
       <div class="form-group ${show_hidepricing_delivery}">
        <label for="">Delivery Cost</label>
         <input type="text" class="form-control" name="pricing_delivery" value="${pricing_delivery}" readonly>
       </div>
<div class="form-group>
        <label for="">Total</label>
         <input type="text" class="form-control" name="total_pricing" value="${total_pricing}" readonly>
       </div>
       <div class="form-group">
        <label for="">Payment options</label>
         ${pay_mode}
       </div>

       <div class="form-group ${show_hideuimessage}">
        <label for="">Comment</label>
       <textarea name="owner_msg" class="form-control disable_newline" cols="30" rows="2" readonly>${atob(ui_message)}</textarea>
       </div>
       <div class="form-group d-none">
        <label for="">client msg</label>
       <textarea name="client_msg" class="form-control disable_newline" cols="30" rows="2" readonly>${atob(description)}</textarea>
       </div>
       <input type="submit" name="submit" class="submit_btn d-none" value="submit">
       
       
        `);


//
         


$('.client_productname').val(productName);
 
     
     
   


  }
  //client code
//disable new line on textarea"
$('.disable_newline').keyup( function() {
  $(this).val( $(this).val().replace( /\r?\n/gi, '' ) );
});
//disable new line on textarea"
  
  function get_chatrequest_order(){
    //
  
        //
        $.ajax({
        //url:`${link}recrutant_application`,
        url:'./get_chatrequest_order',
        type:"get",
        //data:$('#contactform').serialize(),
        //dataType:"json",
        success:function(data)
        {
      
      
    if(data.status)
    {
     var myresult=data.result;
     check_platform=data.platform_data.platform;
     var hideAdmin=data.platform_data.platform==='{{env('Client')}}'?'':'d-none';//hide when on admin

     var getdata=``;

                



    
     for(var i=0;i<myresult.length;i++)
     {
    
    
   getdata+=`<div class="card" >
        <div class="card-header myheader_card " id="faqhead_${myresult[i].id}" >
          <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq_${myresult[i].id}" aria-expanded="true" aria-controls="faq_${myresult[i].id}" onclick="return view_this_uid('${myresult[i].id}','${myresult[i].uid}')">Order# ${myresult[i].uid}</a>
        </div>
        
        <div id="faq_${myresult[i].id}" class="collapse" aria-labelledby="faqhead_${myresult[i].id}" data-parent="#faq">
          <div class="card-body data_result_${myresult[i].id} mycollapse_body">
           
          </div>
        </div>
        
        `;
       
      
     }
     
  //$('.notification_ul').html(getdata);
  $('.myaccrodion_result').html(getdata);
  $('.mynotification_title').text('Orders List');

     
    }
    else{
      $('.mynotification_title').text('there is no data');
     
    }


  
            
    
        
        } 
      });
    //
  }
  
  function view_this_uid(id_order,uid){
     //
        //
        $.ajax({
        //url:`${link}recrutant_application`,
        url:'./get_chatrequest',
        type:"get",
        //data:$('#contactform').serialize(),
        //dataType:"json",
        data:{
          uid:uid
        },
        success:function(data)
        {
      
      
    if(data.status)
    {
     var myresult=data.result;
     check_platform=data.platform_data.platform;
     var hideAdmin=data.platform_data.platform==='{{env('Client')}}'?'':'d-none';//hide when on admin

     var getdata=`<li class="poptitle">
                    <p>Order Users List</p>
                    <p class="myclose" onclick="return myclose()"><i class="fas fa-times" aria-hidden="true"></i></p>
                </li> 
                
     
                `;

                



                var mytest={
    "name":"",
    "uid":"",
    "mol_choice":"",
    "rating":0
  };

var mytestarr=[];
                var arr_uid=[];
               // console.log(arr_uid);
     for(var i=0;i<myresult.length;i++)
     {
    
    //convert your rating to 5 stars

var mytotal_rating=myresult[i].total_rating==='0'?5:myresult[i].total_rating;
      var rating_value=Math.round((myresult[i].rating*5/mytotal_rating));
     // console.log(`rating value ${rating_value}`);
var rating_stars=5;
var rating_loop='';
//console.log(rating_value);

for(var r=1;r<=rating_stars;r++)
{
  var rating_class=r>rating_value?'':'rating_back';
  rating_loop+=`<span class="fa fa-star ratingclass  myrating_1 ${rating_class}"></span>`;
}
       //hide_uid===''?arr_uid.push(myresult[i].uid):'none';
       var ishide_warning=myresult[i].total_pricing!='none'?'d-none':'';
       
      var name=data.platform_data.platform===data.platform_data.platform_view?myresult[i].pharmacie_name:myresult[i].name;
      var isconfirmed=myresult[i].status==='confirmed'?'d-none':'';
       var id=myresult[i].id;
       var hide_uid=arr_uid.indexOf(myresult[i].uid)!=-1?'d-none':arr_uid.push(myresult[i].uid);
   

     var mol="";
  
mytestarr.push(myresult[i].mytotal_rating);
if(mytest.rating<myresult[i].mytotal_rating)
{
  mytest.name=name;
  mytest.uid=myresult[i].uid;
  mytest.mol_choice=`<span class="text-danger">(MOL CHOICE)</span>`;
  var mol_choice_data="mol_choice";
  mytest.rating=myresult[i].mytotal_rating;
  
}
else if(mytest.rating==myresult[i].mytotal_rating)
{
  mytest.name=name;
  mytest.uid=myresult[i].uid;
  mytest.mol_choice="";
  var mol_choice_data="none";
  mytest.rating=myresult[i].mytotal_rating;
}
else{
  mytest.name=name;
  mytest.uid=myresult[i].uid;
  mytest.mol_choice="";
  var mol_choice_data="none";
  mytest.rating=myresult[i].mytotal_rating;
}
      

      
     //console.log(mytestarr);
getdata+=`



  <li class="list-group-item bg-midnight-bloom_med text-white ${hide_uid}">Order # ${i+1} ${myresult[i].uid}</li>
<li class="starbucks success mouseover  ${myresult[i].uid+"_"+i} ${myresult[i].uid+"_"+mol_choice_data}">
                    <div class="notify_icon">
                    <span class="waiting_response ${hideAdmin} ${ishide_warning}" ><i class="fas fa-exclamation-triangle " style="color:red" data-toggle="tooltip" data-placement="top" title="Response Pending"></i></span>
                        <span class="icon"><img width="42" class="rounded-circle" src="dashboard/assets//images/avatars/1.jpg" alt=""></span>  
                        
                    </div>
                    <div class="notify_data " onclick="return ${data.platform_data.accept_func}('${myresult[i].uid}','${myresult[i].userid}','${data.platform_data.accepted_status}','${myresult[i].uid_provider}','${myresult[i].pricing}','${myresult[i].pricing_delivery}','${myresult[i].pay_mode}','${btoa(myresult[i].uid_message)}','${btoa(myresult[i].img_url)}','${btoa(myresult[i].description)}','${myresult[i].product_id}','${myresult[i].phone}','${myresult[i].phone2}','${btoa(myresult[i].product_name)}','${btoa(myresult[i].delivering_time)}','${myresult[i].total_pricing}','${btoa(myresult[i].address)}','${btoa(myresult[i].user_delivery_choice)}')">
                        <div class="poptitle">
                           ${name}${mytest.mol_choice} 
                           <div class="myrating-wrapper ${hideAdmin}">${rating_loop} 
        </div>
                        </div>
                        <div class="sub_title ${isconfirmed} old_temp_delete_product d-none">
                         <button class="btn ${data.platform_data.confirm_class}" onclick="return ${data.platform_data.accept_func}('${myresult[i].uid}','${myresult[i].userid}','${data.platform_data.accepted_status}','${myresult[i].uid_provider}','${myresult[i].pricing}','${myresult[i].pricing_delivery}','${myresult[i].pay_mode}','${btoa(myresult[i].uid_message)}','${btoa(myresult[i].img_url)}','${btoa(myresult[i].description)}','${myresult[i].product_id}','${myresult[i].phone}','${myresult[i].phone2}','${btoa(myresult[i].product_name)}','${btoa(myresult[i].delivering_time)}','${myresult[i].total_pricing}','${btoa(myresult[i].address)}','${btoa(myresult[i].user_delivery_choice)}')">${data.platform_data.confirm_text}</button> <button class="btn btn-danger" onclick="return ${data.platform_data.reject_func}('${myresult[i].uid}','${data.platform_data.rejected_status}','${myresult[i].uid_provider}','${myresult[i].pricing}','${myresult[i].pricing_delivery}','${myresult[i].pay_mode}','${myresult[i].uid_message}','${myresult[i].img_url}','${myresult[i].description}','${myresult[i].product_id}','${myresult[i].phone}','${myresult[i].phone2}')">Rejected</button>
                        
                      </div>
                      <div class="sub_title ${isconfirmed} d-none">
                         <button class="btn ${data.platform_data.confirm_class}" onclick="return ${data.platform_data.accept_func}('${myresult[i].uid}','${myresult[i].userid}','${data.platform_data.accepted_status}','${myresult[i].uid_provider}','${myresult[i].pricing}','${myresult[i].pricing_delivery}','${myresult[i].pay_mode}','${btoa(myresult[i].uid_message)}','${btoa(myresult[i].img_url)}','${btoa(myresult[i].description)}','${myresult[i].product_id}','${myresult[i].phone}','${myresult[i].phone2}','${btoa(myresult[i].product_name)}','${btoa(myresult[i].delivering_time)}','${myresult[i].total_pricing}','${btoa(myresult[i].address)}','${btoa(myresult[i].user_delivery_choice)}')">${data.platform_data.confirm_text}</button> <button class="btn btn-danger" onclick="return ${data.platform_data.reject_func}('${myresult[i].uid}','${data.platform_data.rejected_status}','${myresult[i].uid_provider}','${myresult[i].pricing}','${myresult[i].pricing_delivery}','${myresult[i].pay_mode}','${myresult[i].uid_message}','${myresult[i].img_url}','${myresult[i].description}','${myresult[i].product_id}','${myresult[i].phone}','${myresult[i].phone2}')">Rejected</button>
                        
                      </div>
                      <div class="sub_title ${!isconfirmed} d-none">
                         <button class="btn ${data.platform_data.confirm_class}" onclick="return admin_viewconfirmed_order_request('${myresult[i].uid}')">View Order</button>                         
                      </div>
                    </div>
                    <div class="notify_status success d-none">
                    <p>Success Order</p>  
                    </div>
                </li>  

`;


     }
     
  //$('.notification_ul').html(getdata);
  var myselector=`data_result_${id_order}`;
  console.log(myselector);
  $('.'+myselector).html(getdata);

     
    }
    else{
   
    }


  
            
    
        
        } 
      });
    //
  }
 
  function admin_viewconfirmed_order_request(uid){
    $.ajax({
        //url:`${link}recrutant_application`,
        url:'./admin_viewconfirmed_order_request',//
        type:"get",
        //data:$('#contactform').serialize(),
        //dataType:"json",
        data:{
          uid:uid,
        },
        success:function(data)
        {
      
      
    if(data.status)
    {
  console.log("call order table"); 
    
    }


  
            
    
        
        } 
      });
  }
 
function audio_muted(){
  var maudio =document.getElementById('failure');
  maudio.muted=true;
}

function audio_volume(){
  var maudio =document.getElementById('failure');
  maudio.volume=0.4;
}
function audio_play(){
  document.getElementById('failure').play();
}


  //setInterval(function(){ notification_counter(); }, 1000);
  function notification_counter(){
    //
    $.ajax({
        //url:`${link}recrutant_application`,
        url:'./notification_counter',
        type:"get",
        //data:$('#contactform').serialize(),
        //dataType:"json",
        success:function(data)
        {
      
      
    if(data.status)
    {
      //play_audio();
    //$('.play_click').click();
    //console.log(notification);
    //console.log(data.result[0].counter);
    
    if(notification!=data.result[0].counter)
    {
      document.getElementById('failure').play();
      $('.notification_counter').text(data.result[0].counter);
      //audio.play();
     // myautoplay();
    
     
      setTimeout(function(){
        notification=data.result[0].counter;
       // console.log("eric");
}, 20000);
     
    }
   



    }


  
            
    
        
        } 
      });
    //
  }
//view full screen Image
function view_image(img_url){
  
  
  $('.full_screen_image').html(`
  <div class="container-fluid">
  
  <img src="upload/${img_url}" class="img-fluid myimage" onclick="zoom_out_img()" alt="Responsive image">
  
 
  </div>
 
  `);
  $('.full_screen_image').toggleClass("d-none");
return false;
}
function zoom_out_img(){
  $('.full_screen_image').toggleClass("d-none");
}
//view full screen Image

  //nofification counter
 
 function show_notification(){
  
  //$('.notifications').toggleClass("d-none");
  //view_all_notification();
 $('.link').click();
 }
 function view_all_notification(){
  get_chatrequest_order();
  return false;
 }
		$(document).ready(function(){
			$(".profile .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			  $(".notifications").removeClass("active");
			});

			$(".notifications .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			   $(".profile").removeClass("active");
			});

			$(".show_all .link").click(function(){
			  $(".notifications").removeClass("active");
			  $(".popup").show();
			});

			$(".myclose").click(function(){
        console.log("mypopup");
			  $(".popup").hide();
			});
		});

function myclose(){
  console.log("mypopup");
  $(".popup").hide();
}
   
  </script>
  
  <script>
 function check_empydiv(){
    if($('.append_btn button').hasClass('btn'))
   {
     if($(".choose_pay_mode").hasClass('d-none'))
     {
      $(".choose_pay_mode").removeClass("d-none");
     }
   
   }
   else{
    $(".choose_pay_mode").addClass("d-none");
   }
    if($('.append_tag button').hasClass('btn'))
   {
    $(".added_pay_mode").removeClass("d-none");
   }
   else{
    $(".added_pay_mode").addClass("d-none");
   }
   //console.log($('.append_btn button').hasClass('btn'));
   
   
  }
 
function choose(thisdata)//choose payment Mode
{
var mytag=thisdata.value;

  $('.append_tag').append(`<button class="btn btn-primary p-relative mr-2" onclick="remove(this)" id="${mytag}">
      <input type="hidden" name="pay_mode[]" value="${mytag}">${mytag}
            <span class="p-absolute mytag">X</span>
          </button>`);
  thisdata.remove();
  check_empydiv();
}
function remove(thisdata)
{
  var mytag=thisdata.id;
  thisdata.remove();
  $('.append_btn').append(`
  <button class="btn btn-success" onclick="choose(this)"  value='${mytag}'><input type="checkbox"> ${mytag}</button>
  `);
  check_empydiv();
}
</script>

@if (\Session::has('paymentsuccess'))
 <script>
 payment_successful();
 function payment_successful(){
  Swal.fire({
  title: '',
  text: "Payment successfully submitted",
  icon: 'success',
  
  
}).then((result) => {
  console.log("true");
}) 
   
}
 </script>
  @endif

  @if (\Session::has('paymentfailed'))
 <script>
 payment_failed();
 function payment_failed(){
  Swal.fire({
  title: '',
  text: "Payment Failed please Contact System admin for more infos",
  icon: 'error',
  
  
}).then((result) => {
  console.log("true");
}) 
   
}
 </script>
  @endif


  @if (\Session::has('paymentcancel'))
 <script>
 payment_canceled();
 function payment_canceled(){
  Swal.fire({
  title: '',
  text: "Payment Cancelled please Contact System admin for more infos",
  icon: 'info',
  
  
}).then((result) => {
  console.log("true");
}) 
   
}
 </script>
  @endif
      </div>
</body>
</html>
