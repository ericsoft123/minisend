<template>
<div class="container pt-4">
 <div class="cover-spin"  v-if="spin_show"></div>
   <div class="row">
       <div class="col-md-4">
<div class="form-group">
    <button class="btn btn-block btn-danger" @click="Compose_email()">Composer Email</button>
</div>
<ul class="list-group">
<li class="list-group-item d-flex justify-content-between align-items-center activex" @click="Set_action_name('posted_emails')">
    Posted
<span class="badge badge-primary badge-pill">{{post_email_count}}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center" @click="Set_action_name('sent_emails')">
    Sent
    <span class="badge badge-primary badge-pill">{{sent_email_count}}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center" @click="Set_action_name('failed_emails')">
    Failed
    <span class="badge badge-primary badge-pill">{{failed_email_count}}</span>
  </li>


 
</ul>
           
       </div>

       <div class="col-md">
           <!--search Input-->
<div class="col-md" v-if="show_visible.search_show">
    <input type="text" class="form-control" v-model="search_input_data" @input="SearchAction()" placeholder="seach by  sender, recipient, subject
">


</div>
           <!--search Input-->
<!--table-->
<div class="col-md pt-2">
 <table class="table table-inbox table-hover" v-if="show_visible.table_show">
          <tbody v-bind:key="email_item.id" v-for="email_item in email_data">
            <tr class="unread" @click="View_email(`${email_item.subject}`,`${email_item.recipient_name}`,`${email_item.recipient_email}`,`${email_item.email_content}`,`${email_item.att_url}`)">
              <td class="inbox-small-cells">
                <input type="checkbox" class="mail-checkbox">
              </td>
              <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
              <td class="view-message  dont-show">{{email_item.recipient_name}}</td>
              <td class="view-message ">{{email_item.subject}}</td>
              <td class="view-message  inbox-small-cells"><i :class="[email_item.att_url!='none'?'':'d-none','fa fa-paperclip']"></i></td>
              <td class="view-message  text-right">{{email_item.created_at}} AM</td>
            </tr>
            
        
          </tbody>
        </table>
    </div>
<!--table-->






<!--view-email-->
<div v-if="show_visible.email_view_show">

  <div class="col-md pt-2" v-html="email_view">
  
               
    </div>
   <div class="email_attach" >
      <p v-for="(image,index) in img_att" :key="index">
    {{image}}
  </p>
   </div>
</div>
    
<!--view-email-->

<form  v-if="show_visible.form_show" @submit.prevent="submit">

<div class="form-group">
<label for="">Recipient Name</label>
<input type="text" class="form-control" v-model="fields.recipient_name" required>
</div>
<div class="form-group">
<label for="">Recipient Email</label>
<input type="text" class="form-control" v-model="fields.recipient_email" required>
</div>
<div class="form-group">
<label for="">Subject</label>
<input type="text" class="form-control" v-model="fields.subject" required>
</div>
<div class="form-group">
<label for="">Content</label>
<textarea class="form-control" id="" cols="30" rows="10"  v-model="fields.content" required></textarea>
</div>
<div class="form-group">
<input type="file" @change="imagechange" name="images" ref="files"  multiple>
</div>
<div class="m-auto">
  <p v-for="(image,index) in images" :key="index">
    {{image.name}}
  </p>
</div>
<div class="form-group">
<button class="btn btn-primary">Submit</button>
</div>

</form>

       </div>



   </div>
</div>
</template>

<script>



export default {
    data:function(){
        return{
             email_data:[],
             search_input_data: '',
             ActionName:'default',
             show_visible:[],
           
              fields:{},
              post_email_count:'',
              sent_email_count:'',
              failed_email_count:'',
              count_hide:'',
              email_view:'',
              
              spin_show:true,
              images:[],
              img_att:[],
            
        }
    },
    mounted(){
      this.loadcount();
this.SearchAction();
    },
    methods:{
   
      imagechange(){
for(let i=0;i<this.$refs.files.files.length;i++)
{
  this.images.push(this.$refs.files.files[i]);
  console.log(this.images);
}
      },
      submit(){
        var self=this;
        let formData=new FormData();
    
        for(let i=0;i<this.images.length;i++)
        {
          let file=self.images[i];
          formData.append('files['+i+']',file);
        }
        const config={
          headers:{"content-type":"multipart/form-data"}
        }
        this.spin_show=true;
        const json = JSON.stringify(this.fields);
        formData.append('formData',json);
axios.post('/email_actions',formData,config)
  .then((response) => {
   this.fields={};//to reset forms
   self.$refs.files.value="";
   self.images=[];
     this.loadcount();
    this.spin_show=false;
  }).catch(error=>{
console.log('error');
  });
      },
     View_email(subject,recipient_name,recipient_email,email_content,img_attName){

this.show_visible.push(this.show_visible.email_view_show=true);
this.email_view=`

  <div class="card border-primary mb-3" >
  <div class="card-header">${subject}</div>
  <div class="card-body text-primary">
    <h5 class="card-title"><strong>${recipient_name}</strong>:${recipient_email}</h5>
    <p class="card-text">${email_content}</p>
  </div>
</div>
`;
this.img_att.splice(0,this.img_att.length);//to empty array before adding new array
if(img_attName!='none')
{

    this.img_att.push(img_attName);
    console.log(this.img_att);
}



      },
      loadcount(){

     try {
               
   axios.get('/loadcount').then((response) => {

          
      //this.email_data=response.data.result;
      if(response.data.status)
      {
       // console.log(response.data.result);
  this.post_email_count=response.data.result.posted_emails;
      this.sent_email_count=response.data.result.sent_emails;
      this.failed_email_count=response.data.result.failed_emails;
      }
    

      //console.log(response.data.result.length);
        });



       
    } catch (error) {
        console.log(error);
    }

      },
        Compose_email(){
          this.show_visible=[];
          this.show_visible.push(this.show_visible.form_show=true);
       /*this.table_show=false;
       this.form_show=true;
       this.search_show=false;
       this.email_view_show=false;*/
       
        },
         

      
       Set_action_name(onclickaction){
        
         this.ActionName=onclickaction;
          this.show_visible=[];
          this.show_visible.push(this.show_visible.table_show=true);      
          this.show_visible.push(this.show_visible.search_show=true);      
         /*  this.table_show=true;
       this.form_show=false;
       this.search_show=true;
       this.email_view_show=false;*/
       this.search_input_data='';//reset search input
       this.SearchAction();
        },
          SearchAction(){
            //console.log(this.search_input_data);
            
this.spin_show=true;
              try {
               
   axios.get('/search_email_actions',{
     params:{
       action_name:this.ActionName,
       search_input:this.search_input_data,
     }
   }).then((response) => {

          
      this.email_data=response.data.result;
      this.spin_show=false;
   this.show_visible=[];
          this.show_visible.push(this.show_visible.table_show=true);      
          this.show_visible.push(this.show_visible.search_show=true);    
      //console.log(response.data.result.length);
        });



       
    } catch (error) {
        console.log(error);
    }
        },

    }
}
</script>