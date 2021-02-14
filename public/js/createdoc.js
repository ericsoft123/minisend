
var popover_title="<b>Click Field to Link to Link</b> - ID";
var linkid1="linkid1";
var namefield1="name1";
var linkid2="linkid2";
var namefield2="tel2";
var linkid3="linkid3";
var namefield3="idnumber3";


$(function(){
  
  get_documents();
  //test_getformdata();
  
});
//function choose documents
function choose_docs(choose)
{
  table_id=choose.value;
  $('#tableid').val(table_id);
  //$('#doc_name').val(choose.value);
  //console.log($("#documents option:selected").title);
  var option_name = $('option:selected',choose).attr('data-name');
  $('#doc_name').val(option_name);

  $.ajax({
url:"./admin_getdocumentcodes",
type:"post",
data:{table_id:table_id},
success:function(data){
       // console.log(data);
       if(data!='0')
       {
        $('.form_submit_preview').html(data[0].doc_code);
        $('.div_builder').html(data[0].builder_code);
        $('.reqdoc_submit_preview').html(data[0].req_docs);
        $('.reqdocbuilder').html(data[0].reqdoc_builder);
       
       
        
        getcode();//this is to make my div generate code automaticaly
        
        //this will come after to avoid conversion of code to php to liquid
        $('.admin_view').html(data[0].adminview_code);
}

     
    }
});

 
}
//function choose documents

//var togglefunctdata = 0;
function choose_form(){
  formitem=$('#choose_form').val();
  //alert(formitem);
  
    var idn=Date.now();
    var div_id="div_"+idn;
      var item_id="item_"+idn;
      var label_id="label_"+idn;
      var span_id="span_"+idn;
      var valid_id="valid_"+idn;
      var labeledit_id="labeledit_"+idn;
      var option_disp="optiondisp_"+idn;
      var textoption="textoption_"+idn;
      var state_id="state_"+idn;//for toggle purpose only
      var spanchange="spanchange_"+idn;
      var image_id="image_"+idn;
      var divrestr_id="divrestr_"+idn;
      var checkrestr_id="checkrestr_"+idn;
      

      //var appdevform="appdevform_"+idn;
  if(formitem==='input')
  {
     //change append to prepend for reversing order to show the last one starting
     $('.div_builder').prepend(`
    <div id="${div_id}" class="${div_id}">

    
<div class="row">
${prepend_caption_mandatoryfield(idn,popover_title,labeledit_id)}

${prepend_add_validation(idn,state_id,valid_id)}


</div>

<div class="form-group">
<label><span id="${label_id}" class="${label_id}"></span> <span id="${span_id}" class="${span_id}"></span></label>
<div class="input-group">

  <input type="text" name="${item_id}" id="${item_id}" class="form-control ${item_id}" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
  
  <div class="input-group-append">
    <button class="btn btn-danger"  onclick="form_delete(${idn})" type="button">Delete</button>
    
  </div>
</div>
</div>

<hr>
      </div>

      
      
      `);


      $('.form_submit_preview').prepend(`
     
     <div class="form-group ${div_id}">
     ${prepend_add_restriction(idn,checkrestr_id,divrestr_id)}
<label><span  class="${label_id}"></span> <span  class="${span_id}"></span></label>
<input type="text" name="${item_id}" onkeyup="add_text(this,${idn})" class="form-control ${item_id}"  placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
  
</div>
      `);

      $('.div_code').prepend(`
      <div class="form-group ${div_id}">
$${item_id}=$request->input(${item_id}) ?: 'none';
      </div>
      `);
//i am using liquid syntax to be able to 
      $('.admin_view').prepend(`
      %}
  <div class="form-group ${div_id} {%php if(in_array('${div_id}', $items)) 
  { echo'd-none'; } %} ">
  {%php
  if(!in_array('${div_id}', $items)) 
  { 
    %}
    <p><span class="${label_id}"></span>:<span class="${item_id}"></span></p>
    
    {%php
  } 
  %}

</div>
{%php



 `);
      getcode();
  }
  else if(formitem==='select'){
    $('.div_builder').prepend(`
    <div id="${div_id}" class="${div_id}">
    
<div class="row">
${prepend_caption_mandatoryfield(idn,popover_title,labeledit_id)}

${prepend_add_validation(idn,state_id,valid_id)}

<div class="col-md-12">


<div class="form-group">
<label>Add more options</label>
<div class="input-group">


<input type="text" class="form-control ${textoption}" id="${textoption}" placeholder="Enter Option">
  
  <div class="input-group-append">
    <button class="btn btn-primary"  onclick="add_moreoption(${idn})" type="button">Add options</button>
    
  </div>
</div>

</div>



<div class="${option_disp} form-group"></div>
</div>
</div>

    
  


      <div class="form-group" >
<label><span id="${label_id}" class="${label_id}"></span> <span id="${span_id}" class="${span_id}"></span></label>
<div class="input-group">

<select name="${item_id}" id="${item_id}" class="form-control ${item_id}"></select>
  
  <div class="input-group-append">
    <button class="btn btn-danger"  onclick="form_delete(${idn})" type="button">Delete</button>
    
  </div>
</div>
</div>
<hr>
      </div>
     
      `);

      $('.form_submit_preview').prepend(`
      <div class="form-group ${div_id}">
      ${prepend_add_restriction(idn,checkrestr_id,divrestr_id)}
<label><span  class="${label_id}"></span> <span  class="${span_id}"></span></label>

<select name="${item_id}"  class="form-control ${item_id}" onchange="get_select(this,${idn})"></select>
</div>
      
      `);
      $('.div_code').prepend(`
      <div class="form-group ${div_id}">
$${item_id}=$request->input(${item_id}) ?: 'none';
      </div>
      `);
      $('.admin_view').prepend(`
      %}
       <div class="form-group ${div_id} {%php if(in_array('${div_id}', $items)) 
  { echo'd-none'; } %} ">
  {%php
  if (!in_array('${div_id}', $items)) 
  { 
    %}
    <p><span class="${label_id}"></span>:<span class="${spanchange}"></span></p>
    
    {%php
  } 
  %}

</div>
{%php
      `);
      getcode();
  }
  else if(formitem==='image'){
  
    //change append to prepend for reversing order to show the last one starting
    $('.div_builder').prepend(`
    <div id="${div_id}" class="${div_id}">

    
<div class="row">
${prepend_caption_mandatoryfield(idn,popover_title,labeledit_id)}

${prepend_add_validation(idn,state_id,valid_id)}

</div>

<div class="form-group">

<label><span id="${label_id}" class="${label_id}"></span> <span id="${span_id}" class="${span_id}"></span></label>
<div class="input-group">

  <input type="file" name="${item_id}" id="${item_id}" class="form-control ${item_id}" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
  
  <div class="input-group-append">
    <button class="btn btn-danger"  onclick="form_delete(${idn})" type="button">Delete</button>
    
  </div>
</div>
</div>

<hr>
      </div>

      
      
      `);


      $('.form_submit_preview').prepend(`
      <div class="form-group ${div_id}">
      ${prepend_add_restriction(idn,checkrestr_id,divrestr_id)}
<label><span  class="${label_id}"></span> <span  class="${span_id}"></span></label>
<input type="file" name="file[]" onchange="getimage(this,${idn})" class="form-control ${item_id}"  placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
<input type="hidden" name="filenamedata[]"  class="form-control ${image_id}"  placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
  
</div>
      
      `);

      $('.div_code').prepend(`
      <div class="form-group ${div_id}">
$${item_id}=$request->input(${item_id}) ?: 'none';
      </div>
      `);

      $('.admin_view').prepend(`
      %}
        <div class="form-group ${div_id} {%php if(in_array('${div_id}', $items)) 
  { echo'd-none'; } %} ">
  {%php
  if(!in_array('${div_id}', $items)) 
  { 
    %}
    <p><span class="${label_id}"></span>:<span class="${item_id}"></span></p>
    
    {%php
  } 
  %}

</div>
{%php
      `);
      getcode();


  }
  else if(formitem==='Date')
  {
     //change append to prepend for reversing order to show the last one starting
     $('.div_builder').prepend(`
    <div id="${div_id}" class="${div_id}">

    
<div class="row">
<div class="col-md-12">
<h3>Add Caption</h3>
<div class="form-group">

<input type="text" id="${labeledit_id}"  onkeyup="add_caption(${idn})" class="form-control ${labeledit_id}">
</div>
</div>

<div class="col-md-12" onclick="togglefunct(${idn})">
<div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input ${state_id}" id="${state_id}" value="0" onclick="togglefunct(${idn})">
  <label class="custom-control-label" for="${state_id}">validation:<span   id="${valid_id}" class="${valid_id}" style="color:red">Disable</span></label>
</div>


</div>

</div>

<div class="form-group">
<label><span id="${label_id}" class="${label_id}"></span> <span id="${span_id}" class="${span_id}"></span></label>
<div class="input-group">

  <input type="text" name="${item_id}" id="${item_id}" class="form-control ${item_id}" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
  
  <div class="input-group-append">
    <button class="btn btn-danger"  onclick="form_delete(${idn})" type="button">Delete</button>
    
  </div>
</div>
</div>

<hr>
      </div>

      
      
      `);


      $('.form_submit_preview').prepend(`
      <div class="form-group ${div_id}">
<label><span  class="${label_id}"></span> <span  class="${span_id}"></span></label>
<input type="text" name="${item_id}" onkeyup="add_text(this,${idn})" class="form-control ${item_id}"  placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
  
</div>
      
      `);

      $('.div_code').prepend(`
      <div class="form-group ${div_id}">
$${item_id}=$request->input(${item_id}) ?: 'none';
      </div>
      `);
//i am using liquid syntax to be able to 
      $('.admin_view').prepend(`
      %}
  <div class="form-group ${div_id} {%php if(in_array('${div_id}', $items)) 
  { echo'd-none'; } %} ">
  {%php
  if(!in_array('${div_id}', $items)) 
  { 
    %}
    <p><span class="${label_id}"></span>:<span class="${item_id}"></span></p>
    
    {%php
  } 
  %}

</div>
{%php



 `);
      getcode();
  }
  

}
function prepend_add_validation(idn,state_id,valid_id){
  return`<div class="col-md-12" onclick="togglefunct(${idn})">
<div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input ${state_id}" id="${state_id}" value="0" onclick="togglefunct(${idn})">
  <label class="custom-control-label" for="${state_id}">validation:<span   id="${valid_id}" class="${valid_id}" style="color:red">Disable</span></label>
</div>



</div>`;
}

function prepend_add_restriction(idn,checkrestr_id,divrestr_id){
  return `<div style="float:right" class="restrict">
      <div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input ${checkrestr_id}" id="${checkrestr_id}" onclick="restriction(${idn})" value="0">
  <label class="custom-control-label" for="${checkrestr_id}">Restriction</label>
</div>
<div class="${divrestr_id}"></div>
      </div>`;
}
function prepend_caption_mandatoryfield(idn,popover_title,labeledit_id){
  return `
<div class="col-md-12">
<h3>Add Caption and Link -> <button type="button" class="btn btn-primary popovercls" title="${popover_title}"   data-html="true"  data-container="body" data-toggle="popover"  data-placement="bottom"
            data-content="default" datatest="default" onclick="popover_show(this,${idn})">
 
${idn} !
</button></h3>
<div class="form-group">

<input type="text" id="${labeledit_id}"  onkeyup="add_caption(${idn})" class="form-control ${labeledit_id}" placeholder="Enter Field Name here">
</div>
</div>
  `;

}
function form_delete(idn)
{
    var div_id="div_"+idn;
    $('.'+div_id).remove();
    getcode();
}



function add_caption(idn){
 var  label_id="label_"+idn;
  var labeledit_id="labeledit_"+idn;
  var labelinput=$('.'+labeledit_id).val();
 
  $('.'+labeledit_id).attr("value",labelinput);//to change default value
  $('.'+label_id).text(labelinput);
  getcode();
}
function togglefunct(idn){
  var item_id="item_"+idn;
  var state_id="state_"+idn;
  var state=$('.'+state_id).val();
      var span_id="span_"+idn;
  var valid_id="valid_"+idn;
  if (state === "0") {//disable then on click to be enable
  
    // code snippet 1
   $('.'+valid_id).text("Enable");
   $('.'+valid_id).css("color","green");
   $('.'+item_id).prop("required",true).attr('required', 'required');
 
   $('.'+span_id).text("*");
   $('.'+span_id).css("color","red");
   
  
   $('.'+state_id).val('1');
   $('.'+state_id).prop('checked', true).attr('checked', 'checked');
   getcode();
  } else {
    // code snippet 2
    $('.'+valid_id).text("Disable");
    $('.'+valid_id).css("color","red");
    $('.'+item_id).prop("required",false).removeAttr('required');;
    
    $('.'+span_id).text("");
    
    $('.'+state_id).val('0');
    $('.'+state_id).prop('checked', false).removeAttr('checked');
    getcode();
  }
    
}
function add_moreoption(idn){
  var idn2=Date.now();
  var option_disp="optiondisp_"+idn;
  //var divoption="divoption_"+idn;
  var divoption="divoption_"+idn2;
  var textoption_id="textoption_"+idn;
  var textoption=$('.'+textoption_id).val();
  //var option_id="option_"+idn;
  var option_id="option_"+idn2;
  var item_id="item_"+idn;
  if(textoption!=''){
    if(!$('.'+item_id).find("option:contains('" + textoption  + "')").length){
//do stuff
$('.'+option_disp).prepend(`
  <div>
  

  <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center ${divoption}" id="${divoption}">
  ${textoption}
    <span class="badge badge-danger badge-pill" onclick="remove_moreoption(${idn2})">Delete</span>
  </li>
 
</ul>
  </div>
  `);
  
  $('.'+item_id).prepend(`<option value="${textoption}" id="${option_id}" class="${option_id}">${textoption}</option>`);
  $('.'+textoption_id).val("");
  getcode();
//do stuff
}
else{
  alert("this value exist please type new one please");
  getcode();
}
  }
  else{
    alert("your option is empty");
    getcode();
  }
  



}
function remove_moreoption(idn2){
  var divoption="divoption_"+idn2;
  var option_id="option_"+idn2;
//alert(idn);
  $('.'+divoption).remove();
  $('.'+option_id).remove();
  getcode();
}

function remove_moreoption2(divoption){

//alert(idn);
var div_len=$('.listdocs').length;
if(div_len===2){//because listdocs will be on 2 div
  console.log(div_len);
  $('.listdocs_caption').remove();
  $('.'+divoption).remove();
 
getcode();
}
else
{
  $('.'+divoption).remove();
  
getcode();
  
}
 
 
 
}

function getcode(){
  var html_code=$('.form_submit_preview').html();
  $('.forminput_submit_preview').text(html_code);

var html_code1=$('.div_builder').html();
  $('.forminput_builder_preview').text(html_code1);

  var html_code2=$('.div_code').html();
  var remove_html=html_code2.replace(/(<([^>]+)>)/ig, "");
  var rep=remove_html.replace(/-&gt;/ig, "->");

  $('.forminput_code_preview').text(rep);

var html_code3=$('.admin_view').html();
/* replacing liquid tag to get php tag*/


var mapObj = {
    '{%':"<?",
   '%}':"?>",  //this is not errors
   //'-&gt':"->"
};

html_code3 = html_code3.replace(/{%|%}/gi, function(matched){
  return mapObj[matched];
});



var mapObj = {
    '<!--':"<",
   '-->':">"  //this is not errors
   
};

html_code3 = html_code3.replace(/<!--|-->/gi, function(matched){
  return mapObj[matched];
});
/* replacing to get php tag*/


$('.adminview_code').text(html_code3);

var html_code4=$('.form_data').html();

$('.editcode_data').text(html_code4);

var reqdoc_submit_preview=$('.reqdoc_submit_preview').html();
$('.formreqdoc_submit_preview').text(reqdoc_submit_preview);

var reqdocbuilder=$('.reqdocbuilder').html();
$('.formreqdocbuilder_submit').text(reqdocbuilder);


}
function force_title(){
  var listdocs_caption="listdocs_caption";
  if(!$(".req_docs_disp div").hasClass(`${listdocs_caption}`))
  {
   //
   $('.req_docs_disp').prepend(`<div class="text-center listdocs_caption"><input type="text" value="List of Documents Required" style="width:100%;text-align: center;" class="listdocs_caption_input" onkeyup="listcaption(this)"></div>`);
   $('.reqdoc_submit_preview').prepend(`<div class="text-center listdocs_caption"><span class="listdocs_caption_input">List of Documents Required</span></div>`);
 getcode();
//
  }
  else{
    var val_listdocs=$('.listdocs_caption_input').val();
$('.listdocs_caption').remove();
//
$('.req_docs_disp').prepend(`<div class="text-center listdocs_caption"><input type="text" value="${val_listdocs}" style="width:100%;text-align: center;" class="listdocs_caption_input" onkeyup="listcaption(this)"></div>`);
$('.reqdoc_submit_preview').prepend(`<div class="text-center listdocs_caption"><span class="listdocs_caption_input">${val_listdocs}</span></div>`);


getcode();
//
  }
}
function listcaption(valdata)
{
  valdata=valdata.value;
 // console.log(valdata);
$('.listdocs_caption_input').text(valdata);
$('.listdocs_caption_input').attr("value",valdata);


getcode();

}
function add_reqs(par){
  var divoption=par.value;
  
  //console.log(par.options);

  
  var textoption=$(".req_docs option:selected").text();
  
 
  if(!$(".req_docs_disp div").hasClass(`${divoption}`))
  {
    
  //
  
  $('.req_docs_disp').prepend(`


<div class="${divoption} listdocs">
  


  <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center" id="${divoption}">
  ${textoption}
    <span class="badge badge-danger badge-pill" onclick="remove_moreoption2('${divoption}')">Delete</span>
  </li>
 
</ul>
<hr>
  </div>

`);
$('.reqdoc_submit_preview').prepend(`

<div class="${divoption} listdocs">
  


  <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center" id="${divoption}">
  ${textoption}
    <span class="badge badge-danger badge-pill">Required</span>
  </li>
 
</ul>
<hr>
  </div>
`);

force_title();
    //
 
  }
  else{
  alert("this value exist please choose new one ");
 
}

}

function get_documents(){
  
  $.ajax({
url:"./testgetname",
type:"get",
success:function(data){
       // console.log(data);
       var getdata="";
       var getobj={};
       
       
        for(var i=0;i<data.length;i++)
        {
            //console.log(data[i].doc_name);
            getdata +=`<option value="${data[i].doc_id}" data-name="${data[i].doc_name}">${data[i].doc_name}</option>`;
            getobj[data[i].doc_id]=data[i].doc_name;
        }
        $('#documents').html(getdata);

        
        $('.req_docs').html(getdata);
        $('.docs_obj').text(JSON.stringify(getobj));
        
    }
});
}






function uploadcode(){
  $.ajax({
			//url:"./create_doc",
			//url:"./test_documentscode",
			url:"./admin_documentcodes",
			type:"post",
			data:$('#uploadcode').serialize(),
			success:function(data){
	/*var message=data.message;
			//alert(message);
				swal({
                title: "well Done!",
               text:message,
                type: "success"
	 
          });
				
				location.reload();*/
			}
			
		});
    return false;
}






/*end this is for form data code*/

/*mandatory field */
function popover_show(thisdata,idn){
  $('#popoverid').val(idn);
 
  /*var getpopoverdata=$('.popover-body').html(); 
  $('.popoverdata').html(getpopoverdata); 
  */
  //console.log();
  if($('.popoverdata ul').length>0){
    $(thisdata).popover('show');
    var popoverhide=$('.popoverdata').html();
  $('.popover-body').html(popoverhide);
  $('.listactive').text(idn);

 //console.log("greater");
 //console.log($('.popoverdata ul').length);
  }else{
    //console.log("less");
    //console.log($('.popoverdata ul').length);
    //
//console.log(idn);

  

  //var datacontent=$('.popovercls').attr('data-content','default');
  
    $('.popovercls').attr('data-content',`<ul class='list-group'>
            <li class='list-group-item list-group-item-action active listactive'  data-toggle='list' role='tab' aria-controls='home' style='color:white'>${idn}</li>
            <li class='list-group-item d-flex justify-content-between align-items-center'>
    <span class='linkid1'></span>
    <span class='badge badge-primary badge-pill linkid10' onclick='link(this)' data-id=${idn} data-name=${namefield1} data-link=${linkid1}>Name</span>
  </li>
  <li class='list-group-item d-flex justify-content-between align-items-center'>
    <span class='linkid2'></span>
    <span class='badge badge-primary badge-pill linkid20' onclick='link(this)' data-id=${idn} data-name=${namefield2} data-link=${linkid2}>Tel</span>
  </li>
  <li class='list-group-item d-flex justify-content-between align-items-center'>
    <span class='linkid3'></span>
    <span class='badge badge-primary badge-pill linkid30' onclick='link(this)' data-id=${idn} data-name=${namefield3} data-link=${linkid3}>ID or Passport</span>
  </li>
</ul>`);
$('.listactive').text(idn);
$(thisdata).popover('show');
    //
  }
  
 
    
  
 


}
function link(thisdatas){
  //var vardata=$('.badge',thisdatas).attr("data-id");
  //var idn=$(thisdatas).attr("data-id");
  //var linkdata=$('.linkdata').text();
  var idn=$('#popoverid').val();
  if(!$('ul').find("span:contains('" + idn + "')").length){
    if($('.'+linkid).first().text!='')//just to change field name
    {
 //var idn=$('.listactive').text();;
 var linkid=$(thisdatas).attr("data-link");
  var fieldname=$(thisdatas).attr("data-name");
  /*console.log(idn);
  console.log(linkid);
  console.log(fieldname);*/

/*change first the current field name */
var link_idn=$('.'+linkid).first().text();
//console.log(link_idn);
var olditem_id="item_"+link_idn;
$('.'+olditem_id).attr("name",olditem_id);//let me assign to idn
/*change first the current field name */

  var item_id="item_"+idn;
  $('.'+item_id).attr("name",fieldname);
  
  $('.'+linkid).text(idn);
var getpopoverdata=$('.popover-body').html(); 
  $('.popoverdata').html(getpopoverdata); 
//$('.'+linkid).attr("text",idn);
//console.log($('ul').find("span:contains('" + idn + "')").length);

    }
 
  }
  else{
     //console.log("value exist");
    //get class of that element found to be able to remove that element
    var getclass=$('ul').find("span:contains('" + idn + "')").attr('class');
    var linkidclass=getclass+"0";
    linkidclass=$('.'+linkidclass).first().text();
    if(confirm(`id exist  linked to ${linkidclass}! Do you want to link to another Field?`))
    {
//remove first text of linked one
$('.'+getclass).text("");

      //
      if($('.'+linkid).first().text!='')//just to change field name
    {
 //var idn=$('.listactive').text();;
 var linkid=$(thisdatas).attr("data-link");
  var fieldname=$(thisdatas).attr("data-name");
  /*console.log(idn);
  console.log(linkid);
  console.log(fieldname);*/
/*change first the current field name */
var link_idn=$('.'+linkid).first().text();
//console.log(link_idn);
var olditem_id="item_"+link_idn;
$('.'+olditem_id).attr("name",olditem_id);//let me assign to idn
/*change first the current field name */

  var item_id="item_"+idn;
  $('.'+item_id).attr("name",fieldname);
  
  $('.'+linkid).text(idn);
var getpopoverdata=$('.popover-body').html(); 
  $('.popoverdata').html(getpopoverdata); 
//$('.'+linkid).attr("text",idn);
//console.log($('ul').find("span:contains('" + idn + "')").length);

    }
      //
    }
    
  }
  check_mandatory();
  return false;

}
function check_mandatory(){
  var linkid1=$('.linkid1').first().val();
  var linkid2=$('.linkid2').first().val();
  var linkid3=$('.linkid3').first().val();
  if(linkid1==''||linkid2==''||linkid2==''){
    $('.uploadcode').attr("disabled",true);
    getcode();
  }
  else{
    $('.uploadcode').attr("disabled",false);
    getcode();
  }
}

