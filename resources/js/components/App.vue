	<template>
	<div class="h-screen bg-white">
	<div class="flex">

	<!-- left section-->
	<div class="pl-6 bg-regal-blue w-48 h-screen border-r-2 border-gray-400">
	<!-- left section nav -->
	<nav class="pt-4">
	<router-link to='/'> 
	<!-- <svg class="fill-current text-blue-600 w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
	<path d="M3.9 4.2c-.5 0-.8.3-.8.8s.4.8.8.8c.5 0 .8-.4.8-.8.1-.5-.3-.8-.8-.8zM3.3 18.6c0 1.4-.2 2.1-1.5 2.1-.3 0-.7 0-.9-.1l-.3 1.1c.3.1.7.2 1.1.2 1.9 0 2.7-1.2 2.7-3.2V8.1H3.3v10.5zM9.4 17.5c1.4 0 2.3-.4 3-1.2.8-1 1.1-2.1 1.1-3.8 0-1.4-.2-2.7-1-3.5-.6-.7-1.5-1.1-2.9-1.1s-2.3.4-3 1.2c-.8 1-1.1 2.2-1.1 3.8 0 1.5.2 2.6 1 3.5.6.7 1.5 1.1 2.9 1.1zM7.5 9.7c.3-.4.9-.8 2-.8 1 0 1.6.3 1.9.7.5.6.7 1.7.7 2.9s-.2 2.4-.7 3.1c-.3.4-.9.8-2 .8-1 0-1.6-.3-1.9-.7-.5-.6-.7-1.6-.7-2.9 0-1.2.2-2.4.7-3.1zM15 14.4c0 2.1.4 3.1 2.5 3.1.6 0 1.3-.1 1.8-.2l-.1-1c-.5.1-1 .2-1.5.2-1.4 0-1.5-.6-1.5-2.1v-5h3V8.3h-3v-3l-1.2.2v2.7h-1.8v1.1H15v5.1zM6 18h17v1H6z"/>
	</svg> -->
	
		<!-- <h1 class="text-white text-1xl font-bold ml-5 font-mono">Church Planner</h1> -->
        <img src="https://i.pinimg.com/originals/fe/31/48/fe314846de599f3839d898ab617bf399.gif" alt="" class=" rounded-sm pr-6">
	</router-link>
	 
	<p class=" pt-12 text-white uppercase font-bold text-xs">Dashboard</p>
	<!-- add new content routed to ContactsCreate.vue -->
	<router-link to="/members/create" class="flex items-center py-2 
	hover:text-yellow-600 text-1xl text-white"> <font-awesome-icon icon="user-plus"  /> 
	<div class="tracking-wide pl-3 text-white">Add New</div>
	</router-link>
	<p class=" pt-12 text-white uppercase font-bold text-xs">General</p>
	<!-- add new content routed to members.vue -->
	<router-link to="/members" class="flex items-center py-2 
	hover:text-yellow-600 text-1xl text-white">
	<font-awesome-icon icon="address-card"  /> 
	<div class="tracking-wide pl-3 text-white">Members</div>
	</router-link>
	<router-link to="/cellgroups/create" class="flex items-center py-2 
	hover:text-yellow-600 text-1xl text-white">
	<font-awesome-icon icon="user-circle"  /> 
	<div class="tracking-wide pl-3 text-white">Cellgroups</div>
	</router-link>
	<router-link to="/birthdays" class="flex items-center py-2 
	hover:text-yellow-600 text-1xl text-white">
	<font-awesome-icon icon="birthday-cake"  /> 
	<div class="tracking-wide pl-3 text-white">Birthday</div>
	</router-link>
	<p class=" pt-12 text-white uppercase font-bold text-xs">Settings</p>
	<router-link to="/" class="flex items-center py-2 hover:text-yellow-600 text-1xl text-white">
	<font-awesome-icon icon="sign-out-alt"  />
	<div class="tracking-wide pl-3 text-white">Log out</div>
	</router-link>
	<!-- toggle component -->
	<p class=" pt-12 text-white uppercase font-bold text-s">Extras</p>
	
	<!-- <toggle /> -->
	


	</nav>
	</div>
	<!-- right section -->
	<div class="flex flex-col flex-1 h-screen overflow-y-hidden">
	<!-- top section-->
	<div class="h-16 px-6 border-b border-regal-blue flex items-center justify-between">
		<div>
			Members
		</div>
		<div class="flex items-center">
				<!-- UserCircle components -->
			<SearchBar />
			<UserCircle :name="user.name" />
			</div>
	
	
		
		
	

	</div>
	<!-- bottom -->
	<div class="flex flex-col overflow-y-hidden flex-1">
		<!-- imported router vue files -->
		<router-view class="p-6 overflow-x-hidden" :key="$route.fullPath"></router-view>
	</div>
	</div>
	<!--end main flex -->
	</div> 
	
	<!--end wrapper class -->
	</div>
	</template>
<!-- call to Axios api -->
<!-- User:Auth imported  -->
<!-- Import windows.axios -->
<!-- we used created() replacing mounted() function since it won't work because of its early api CALL -->
	<script> 
	
	import UserCircle from './UserCircle';
	import SearchBar from './SearchBar';
	

	

	
	export default {

	name: "App",

	props: [
	
		'user',
	],

	components: {

		UserCircle, SearchBar

	},

	created() {
           

            window.axios.interceptors.request.use(
                (config) => {
                    if (config.method === 'get') {
                        config.url = config.url + '?api_token=' + this.user.api_token;
                    } else {
                        config.data = {
                            ...config.data,
                            api_token: this.user.api_token
                        };
                    }
                    return config;
                }
            )
        },
	}

	</script>

	<style scoped>

	</style>