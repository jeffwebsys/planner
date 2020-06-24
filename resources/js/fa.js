import Vue from 'vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faSync, faBirthdayCake, faSignOutAlt, faUserPlus, faUserCircle, faAddressCard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faSync, faUserPlus, faBirthdayCake, faSignOutAlt, faUserCircle, faAddressCard);

 
Vue.component('font-awesome-icon', FontAwesomeIcon);
 
Vue.config.productionTip = false;

export default{

}