import PerfectScrollbar from 'perfect-scrollbar';
import _ from 'lodash';
import $ from 'jquery';
import axios from 'axios';
import Choices from 'choices.js';
import moment from 'moment';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';
// import DataTable from 'datatables.net-dt';
// import 'datatables.net-responsive-dt';


window.PerfectScrollbar = PerfectScrollbar;
window.Choices = Choices;
window.$ = window.jQuery = $;
window.moment = moment;
window.DataTable = DataTable;


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });



