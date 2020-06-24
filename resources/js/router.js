import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent';
// import Members from './components/Members';
// Members
import MembersIndex from './views/MembersIndex';
import MembersCreate from './views/MembersCreate';
import MembersShow from './views/MembersShow';
import MembersEdit from './views/MembersEdit';
// cellgroups
import CellGroupCreate from './views/cellgroup/CellGroupCreate';


Vue.use(VueRouter);

export default new VueRouter({

    routes: [
        {path: '/', component: ExampleComponent},
        { path: '/members', component: MembersIndex },
        { path: '/members/create', component: MembersCreate },
        { path: '/members/:id', component: MembersShow },
        { path: '/members/:id/edit', component: MembersEdit },
        { path: '/cellgroups/create', component: CellGroupCreate },
       

       
],
    mode: 'history',

});