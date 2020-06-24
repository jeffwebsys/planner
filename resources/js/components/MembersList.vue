<template>
  <div>
    <div v-if="loading">Please wait..</div>
    <div v-else>
        <div v-if="members.length === 0">
            <p>No members yet <router-link to="/members/create" class=" px-4 py-2 bg-gray-900 rounded text-sm font-bold text-white">Create</router-link></p>
        </div>
       <div v-for="member in members">
          <router-link :to="'/members/' + member.data.member_id" class="flex items-center border-b border-gray-400 p-4 hover:bg-gray-100">

               <UserCircle :name="member.data.name" />

           <div class="pl-4">
               <p class="text-blue-400 font-bold"> {{member.data.name}} </p>
               <p class="text-gray-600"> {{member.data.company}} </p>
                <p class="text-gray-600"> {{member.data.position}} </p>

           </div>

          </router-link>
    </div>

    </div>
</div>
  
</template>

<script>
import UserCircle from './UserCircle';

export default {

    name: "MembersList",
    // props endpoint to accomodate the API request to membersIndex

    props: [

        'endpoint'
    ],


    components: {
        UserCircle
    },
     mounted() {

        axios.get(this.endpoint)
        .then(response => {
            //if data is loaded
            this.members = response.data.data;
            //if data is initiated then hide the loading state
            this.loading = false;

        })
        .catch(error => {
            this.loading = false;
            alert('Unable to fetch member');

        });

    },
    
    //data for variables
    data: function (){
        return {
            //initiate at loading state
            // mounted variables
            loading: true,
            members: null,
        }
    }


}
</script>

<style>

</style>