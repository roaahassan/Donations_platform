// استيراد مكتبة Axios
import axios from 'axios';
window.axios = axios;

// إعدادات Axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// استيراد Bootstrap
import 'bootstrap/dist/js/bootstrap.bundle.min.js'; // استيراد JavaScript الخاص بـ Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'; // استيراد CSS الخاص بـ Bootstrap
