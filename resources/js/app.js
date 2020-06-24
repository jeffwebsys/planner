
import Vue from 'vue';
import router from './router';
import fa from './fa';
import alert from './alert';
import App from './components/App';


require('./bootstrap');



const app = new Vue({
    el: '#app',
  components: {
      App
  },
    router, fa, alert,
});
