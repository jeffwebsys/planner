<template>

<div><!-- main wrapper -->
<div v-if="loading" class=" text-gray-700 delay-500">Please Wait...</div>
   
 <div v-else>
        <div class="flex justify-between"> <!-- main flex -->
        <!-- left section -->
    
         <a href="#" @click="$router.back()" class="text-blue-400"> Back</a>
       
        <!-- right section -->
        <div class="relative">

            <router-link :to="'/members/' + member.member_id + '/edit'" class="px-4 py-2 rounded text-sm font-bold text-green-500 border border-green-500 mr-2 hover:bg-green-500 hover:text-white "> Edit</router-link>
            <a href="#" class="px-4 py-2 rounded text-sm font-bold text-red-500 border border-red-500 hover:bg-red-500 hover:text-white" @click="modal = ! modal">Delete</a>
       <!-- if modal is set to true // modal-->
       <div v-if="modal" class="absolute bg-blue-900 text-white rounded-lg z-20 p-8 w-64 right-0 mt-2 mr-6">
           <p>Are you sure you want to delete this record?</p>
           <div class="flex items-center mt-6 justify-end">
            <button @click="modal = ! modal" class="text-white pr-4">Cancel</button>
           <button class="px-4 py-2 bg-red-500 rounded text-sm font-bold text-white" @click="destroy">Delete</button> 
           </div>
        </div>


        </div>
         
        <!-- if modal is triggered let us have density effect -->
         <div v-if="modal" class="bg-black opacity-25 absolute right-0 left-0 top-0 bottom-0 z-10 " @click="modal = ! modal"></div>
    </div>


    <!-- member view -->
    <div class="flex items-center pt-6">
<UserCircle :name="member.name" />
<!-- member.name is an eloquent relationship -->
<p class="pl-5 text-xl">{{ member.name }}</p>
    </div>
    <p class="pt-6 text-gray-600 font-bold uppercase text-sm">Member</p>
    <p class=" pt-2 text-blue-400">{{ member.email}}</p>
    <p class="pt-6 text-gray-600 font-bold uppercase text-sm">Company</p>
    <p class=" pt-2 text-blue-400">{{ member.company}}</p>
    <p class="pt-6 text-gray-600 font-bold uppercase text-sm">Birthday</p>
<p class=" pt-2 text-blue-400">{{ member.birthday}}</p>
 </div>

</div> <!-- End div  Wrapper-->
  
</template>

<script>
import UserCircle from '../components/UserCircle';
export default {

 

    name: "membersShow",

    mounted() {
        axios.get('/api/members/' + this.$route.params.id)
        .then(response => {
            //fetch a member
            this.member = response.data.data;
            this.loading = false;

        }).catch(error => {
        this.loading = false;
        //if page not found let's throw some view
        if(error.response.status === 404){
            this.$router.push('/members');
            this.$swal('Error!','Member Not Found','error','center');
        }

        });


    },
    components: {
        UserCircle
    },
    data: function() {
        return {
            member: null,
            loading: true,
            modal: false,
             
        }
    },
    methods: {
        destroy: function (){
            //deleting a member via API
            axios.delete('/api/members/' + this.$route.params.id).
            then(response => {
                this.$router.push('/members');
                this.$swal('Success!','Member Deleted','info');
            })
            .catch(error => {
                alert('Internal Error. Unable To Delete Member')

            });

        }
    }

}
</script>

<style scoped>

</style>