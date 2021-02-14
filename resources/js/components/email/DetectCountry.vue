<template>

   <div class="wrap-input100 validate-input m-b-23   " data-validate = "Name is required">
						<span class="label-input100">Country</span>
					
			<div class="cover-spin"  v-if="spin_show"></div>		
				         <input type="hidden" class="country_code form-control" name="country_code"  v-model='Country.code'>
				         <input type="text" class="country form-control" name="country" v-model='Country.name'>
                    </div>
</template>

<script>



export default {
    data:function(){
        return{
             Country:{
                 code:'',
                 name:''
             },
             spin_show:true,
            
            
            
        }
    },
    mounted(){
   this.register_detect_country();
    },
    methods:{
      
       register_detect_country(){

     try {
               
   axios.get('/register_detect_country').then((response) => {

          
      //this.email_data=response.data.result;
      if(response.data.status)
      {
          this.spin_show=false;
          var locationdata=JSON.parse(response.data.result);
  this.Country.code=locationdata.country_code;
  this.Country.name=locationdata.country_name;
      }
    
    /*console.log(locationdata.country_code);

      console.log(JSON.parse(response.data.result));*/
        });



       
    } catch (error) {
        console.log(error);
    }

      },
       

      
     

    }
}
</script>