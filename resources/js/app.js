import './bootstrap';

import Alpine from 'alpinejs';
import 'flowbite';
window.Alpine = Alpine;
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Alpine.start();


