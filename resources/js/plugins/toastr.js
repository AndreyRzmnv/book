import Vue from 'vue'
// import Toastr
import Toastr from 'vue-toastr';
// import toastr scss file: need webpack sass-loader
require('vue-toastr/src/vue-toastr.scss');
// Register plugin
  
Vue.use(Toastr);