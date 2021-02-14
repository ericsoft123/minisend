<template>
<div class="container pt-4">
 <div class="cover-spin"  v-if="spin_show2"></div>
   <div class="row">
       <div class="col-md-4">

<ul class="list-group" v-for="(message,index) in message_counterdata" :key="index">
    <li class="list-group-item d-flex justify-content-between align-items-center" @click="admin_total_clients()">
    Total Clients(by partition)
    <span class="badge badge-primary badge-pill">{{user_count}}</span>
  </li>
<li class="list-group-item d-flex justify-content-between align-items-center activex" >
    Total Posted 
    
<span class="badge badge-primary badge-pill">{{message.posted_email}}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center" >
   Total  Sent
    <span class="badge badge-primary badge-pill">{{message.sent_email}}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center" >
    Total Failed
    <span class="badge badge-primary badge-pill">{{message.failed_email}}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center" @click="admin_view_clients()">
    View Clients
    <span class="badge badge-primary badge-pill"></span>
  </li>

   
</ul>


<div class="pt-2" v-if="show_visible.client_email">
    <h3 class="text-center">{{clientName}}</h3>
    <ul class="list-group" >
<li class="list-group-item d-flex justify-content-between align-items-center activex">
 Posted 
    
<span class="badge badge-primary badge-pill">{{message_clientdata.posted_email}}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center" >
   Sent
    <span class="badge badge-primary badge-pill">{{message_clientdata.sent_email}}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center" >
    Failed
    <span class="badge badge-primary badge-pill">{{message_clientdata.failed_email}}</span>
  </li>

</ul>
</div>
           
       </div>

       <div class="col-md">
           <!--search Input-->
<div class="col-md">
    <input type="text" class="form-control" v-model="search_input_data" @input="SearchAction()">


</div>
           <!--search Input-->
<!--table clients-->
<div class="col-md pt-2"  v-if="show_visible.table_client">

 <table class="table table-inbox table-hover">
     <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Country</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
          <tbody v-bind:key="email_item.id" v-for="email_item in email_data">
            <tr class="unread" @click="View_client(`${email_item.table_uid}`,`${email_item.name}`,`${email_item.userid}`)">
              
              <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
              <td class="view-message  dont-show">{{email_item.name}}</td>
              <td class="view-message ">{{email_item.email}}</td>
              <td class="view-message  inbox-small-cells">{{email_item.country}}</td>
            
              <td class="view-message  text-right">{{email_item.created_at}} AM</td>
            </tr>
            
        
          </tbody>
        </table>
    </div>
<!--table clients-->

<!--table partition-->
<div class="col-md pt-2" v-if="show_visible.table_partition">
    <table class="table table-inbox table-hover">
      <thead>
    <tr>
     
      <th scope="col">table ID</th>
      <th scope="col">Country Code</th>
      <th scope="col">Country</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
          <tbody v-bind:key="user_item.id" v-for="user_item in user_data">
            <tr class="unread" >
              
             
              <td class="view-message  dont-show">{{user_item.table_uid}}</td>
              <td class="view-message ">{{user_item.country_code}}</td>
              <td class="view-message  inbox-small-cells">{{user_item.country}}</td>
            
              <td class="view-message  text-right">{{user_item.total}}</td>
            </tr>
            
        
          </tbody>
        </table>
</div>
 
<!--table partition-->





       </div>



   </div>
</div>
</template>

<script>



export default {
    data:function(){
        return{
             email_data:[],
             user_data:[],
             search_input_data: '',
             ActionName:'default',
              view_email:false,
              count_hide:'',
              email_view:'',
              email_view_show:false,
              message_counterdata:'',
                spin_show2:true,
                user_count:'',
                clientName:'',
                message_clientdata:[],
                show_visible:[],
                
            
        }
    },
    mounted(){
    
     this.admin_count_all();
     this.admin_view_clients();
    },
    methods:{
        
          SearchAction(){
            //console.log(this.search_input_data);
            
this.spin_show=true;
              try {
               
   axios.get('/admin_search_client',{
     params:{
      
       search_input:this.search_input_data,
     }
   }).then((response) => {

 this.email_data=response.data.result;
this.show_visible=[];//empty an array before adding new
 this.show_visible.push(this.show_visible.table_client=true);
 this.spin_show2=false;
//console.log(this.show_visible);         
 


        });



       
    } catch (error) {
        console.log(error);
    }
        },
      admin_count_all(){

     try {
               
   axios.get('/admin_count_all').then((response) => {

          
      //this.email_data=response.data.result;
      if(response.data.status)
      {
       
        this.message_counterdata=response.data.result.message_counter;
        this.user_count=response.data.result.user_counter;
      }
    

        });



       
    } catch (error) {
        console.log(error);
    }

      },

         admin_view_clients(){
              try {
                   this.spin_show2=true;
               
   axios.get('/admin_view_clients').then((response) => {

          
    
      if(response.data.status)
      {
     
this.email_data=response.data.result;
this.show_visible=[];//empty an array before adding new
 this.show_visible.push(this.show_visible.table_client=true);
 this.spin_show2=false;
console.log(this.show_visible);
      }
    

      
        });



       
    } catch (error) {
        console.log(error);
    }

      },
      View_client(table_uid,name,userid){
           this.spin_show2=true;
         try {
               
   axios.get('/admin_count_user', {
    params: {
      table_uid:table_uid,
      userid:userid
    }
  }).then((response) => {

          
      //this.email_data=response.data.result;
      if(response.data.status)
      {
       // console.log(response.data.result);
 this.clientName=name;
 this.message_clientdata=response.data.result;
 this.show_visible=[];//empty an array before adding new
  this.show_visible.push(this.show_visible.table_client=true);
  this.show_visible.push(this.show_visible.client_email=true);
   this.spin_show2=false;

      }
    

      //console.log(response.data.result.length);
        });



       
    } catch (error) {
        console.log(error);
    }
      },

      admin_count_user(){
              try {
               
   axios.get('/admin_count_user').then((response) => {

          
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
    admin_total_clients(){//view Total user by country
         this.spin_show2=true;
              try {
               
   axios.get('/admin_view_user').then((response) => {

          
      //this.email_data=response.data.result;
      if(response.data.status)
      {
       // console.log(response.data.result);
  this.user_data=response.data.result;
  this.show_visible=[];//empty an array before adding new
  this.show_visible.push(this.show_visible.table_partition=true);
  console.log(this.show_visible);
   this.spin_show2=false;
      }
    

      //console.log(response.data.result.length);
        });



       
    } catch (error) {
        console.log(error);
    }

      }
    
    
    },
    
}
</script>