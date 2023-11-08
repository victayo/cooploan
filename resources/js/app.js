import './bootstrap';
import './argon-pro';
import DataTable from 'datatables.net-dt';

import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import UserSummaryComponent from './components/UserSummaryComponent.vue';
import NewLoanComponent from './components/loan/NewLoanComponent.vue'
import PaymentScheduleComponent from './components/loan/PaymentScheduleComponent.vue'
import WalletComponent from './components/Dashboard/WalletComponent.vue'


app.component('example-component', ExampleComponent);
app.component('user-summary', UserSummaryComponent);
app.component('new-loan', NewLoanComponent);
app.component('wallet', WalletComponent);
app.component('payment-schedule', PaymentScheduleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
