<template>
<div class="border-solid border-3 border-gray-600">
   
 
    <form @submit.prevent="submitForm()">
        <!-- InputField.Vue -->
     <InputField name="name" label="Member Name" placeholder="" :errors="errors" @update:field="form.name = $event"/>
     <InputField name="email" label="Member Email" placeholder="" :errors="errors" @update:field="form.email = $event"/>
     <InputField name="company" label="Company" placeholder="" :errors="errors" @update:field="form.company = $event"/>
     <InputField name="birthday" label="Birthday" placeholder="MM/DD/YYYY" :errors="errors" @update:field="form.birthday = $event"/>
     <InputField name="position" label="Position" placeholder="" :errors="errors" @update:field="form.position = $event"/>
     <InputField name="location" label="Location" placeholder="" :errors="errors" @update:field="form.location = $event"/>
     <InputField name="offerings" label="Offerings" placeholder="" :errors="errors" @update:field="form.offerings = $event"/>
    
 
   
     

    <!-- buttons -->
         <div class="flex justify-end">
             <button class="py-2 px-4 rounded text-red-700 border mr-5 hover:border-red-700">Cancel</button>
            <loadbtn />
         </div>
    </form>
     </div>
    
</template>

<script>
// import InputField.vue 
// and add as component
import InputField from '../components/InputField';
import loadbtn from '../components/loadbtn';




export default {
    name: "MembersCreate",

    components: {
        InputField, loadbtn, 
    },

    data: function (){

        return {
            //form array value
            form: {
                'name': '',
                'email': '',
                'company': '',
                'birthday': '',
                'position': '',
                'location': '',
                'offerings': '',

            },
            errors: null, 
        }
    },

    methods: {
        //laravel api call through axios and laravel POST
        submitForm: function (){
            axios.post('/api/members', this.form)
            .then(response =>{
                this.$router.push(response.data.links.self);
                this.$swal('Success!','Member Added','success','top-end');
              

            })
            .catch(errors => {
                //if has error
                this.errors =  errors.response.data.errors;
                this.$swal('Check inputs!','Failed','error','top-end');
            });
        }
    }
}
</script>

<style scoped>

</style>