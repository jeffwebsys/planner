<template>
<div>
        <div class="flex justify-between"> <!-- main flex -->
        <!-- left section --> 
        <a href="#" @click="$router.back()" class="text-blue-400 pb-3"> Back</a>
        </div>
    <form @submit.prevent="submitForm()">
        <!-- InputField.Vue -->
     <InputField name="name" label="Member Name" placeholder="Member Name" :errors="errors" @update:field="form.name = $event" :data="form.name"/>
     <InputField name="email" label="Member Email" placeholder="Member Email" :errors="errors" @update:field="form.email = $event" :data="form.email"/>
     <InputField name="company" label="Company" placeholder="Company" :errors="errors" @update:field="form.company = $event" :data="form.company"/>
     <InputField name="birthday" label="Birthday" placeholder="MM/DD/YYYY" :errors="errors" @update:field="form.birthday = $event" :data="form.birthday"/>
     <InputField name="position" label="Position" placeholder="Position" :errors="errors" @update:field="form.position = $event" :data="form.position"/>
     <InputField name="location" label="Location" placeholder="Location" :errors="errors" @update:field="form.location = $event" :data="form.location"/>
     <InputField name="offerings" label="Offerings" placeholder="Offerings" :errors="errors" @update:field="form.offerings = $event" :data="form.offerings"/>


     
     

    <!-- buttons -->
         <div class="flex justify-end">
             <button class="py-2 px-4 rounded text-red-700 border mr-5 hover:border-red-700">Cancel</button>
             <button class="bg-blue-500 py-2 px-4 text-white rounded hover:bg-blue-400">Save</button>

         </div>
    </form>
</div>
    
</template>

<script>
// import InputField.vue 
// and add as component
import InputField from '../components/InputField';


export default {
    name: "MembersEdit",

    components: {
        InputField
    },
  mounted() {
        axios.get('/api/members/' + this.$route.params.id)
        .then(response => {
            //update a using this.form data
            this.form = response.data.data;
            this.loading = false;

        }).catch(error => {
        this.loading = false;
        //if page not found let's throw some view
        if(error.response.status === 404){
            this.$router.push('/members');
            //alert
             this.$swal('Error!','Member Not Found','error','top-end');
        }

        });


    },

    data: function (){

        return {
            //forms value
            form: {
                'name': '',
                'email': '',
                'company': '',
                'birthday': '',
                'postion': '',
                'location': '',
                'offerings': '',


            },
            errors: null, 
        }
    },

    methods: {
        //laravel api call PATCH through axios and laravel
        submitForm: function (){
            axios.patch('/api/members/'+ this.$route.params.id, this.form)
            .then(response =>{
                 this.$swal('Success!','Member Updated','success','top-end');
                this.$router.push(response.data.links.self);
               

            })
            .catch(errors => {
                //if error
                this.errors =  errors.response.data.errors;
            });
        }
    }

   
}
</script>

<style scoped>

</style>