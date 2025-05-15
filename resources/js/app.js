import './bootstrap.js';
import './brand.js';
import './cart.js';
import './float.js';
import './general.js';
import './main.js';
import './slider.js';
// import './textarea.js';
import   './echo.js'
import './toast.js';
import 'flowbite';
import './wow.js';
import './imageCompressor.js';
import Swal from 'sweetalert2';
window.Swal = Swal;
window.axios.defaults.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').getAttribute('content');
import Alpine from 'alpinejs';
window.$ = window.jQuery = $;
window.Alpine = Alpine;

Alpine.start();
