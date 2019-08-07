
require('./bootstrap');
import Vue from 'vue'
import Vuelidate from "vuelidate";
//import VueToastr2 from 'vue-toastr-2'
//import 'vue-toastr-2/dist/vue-toastr-2.min.css'
import Person from './components/Person.vue';

Vue.config.productionTip = false;

Vue.use(Vuelidate);

//Vue.use(VueToastr2)

/*
  Convert vue object
*/
global.getVueObject = obj => {
    return JSON.parse(JSON.stringify( obj ));
};

const app = new Vue({
    el: '#app',
    components: { Person },
});