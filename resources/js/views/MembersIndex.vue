<template>
<!-- props endpoint  -->
<MembersList endpoint="/api/members" />

</template>

<script>

import MembersList from '../components/MembersList';


export default {

    name: "MembersIndex",

    components: {

        MembersList

    },


    
    //mounted for API request
   

}
</script>

<style>

</style>