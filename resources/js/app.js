/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

import VueRouter from "vue-router";
Vue.use(VueRouter);

window.bus = new Vue();
export const bus = new Vue();

import Multiselect from 'vue-multiselect'
// register globally
Vue.component('multiselect', Multiselect)


import 'datatables.net-dt'

import 'vue-search-select/dist/VueSearchSelect.css'

import jsZip from 'jszip';

import 'pdfmake'
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;


import 'datatables.net-buttons-dt'
import 'datatables.net-bs4'
import 'datatables.net-buttons-bs4'

import 'datatables.net-buttons/js/buttons.html5.js'
import 'datatables.net-buttons/js/buttons.print.js'
import 'datatables.net-buttons/js/buttons.colVis.js'

// //for-excel
// window.JSZip = jsZip;

import Swal from "sweetalert2";
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
});
window.Toast = Toast;


import moment from "moment";
//for show date in correct format on vue component
Vue.filter("myDate", function (dateFormatted) {
    return moment(dateFormatted).format("DD - MM - YYYY");
});

Vue.filter("myDateMonth", function (dateFormatted) {
    return moment(dateFormatted).format("MMM Do YYYY");
});









let routes = [
    {
        path: "/",
        component: require("./components/admins/dashboard.vue").default,
    },

    {
        path: "/brand",
        component: require("./components/admins/masters/brand/brandTable.vue").default,
    },
    {
        path: "/model",
        component: require("./components/admins/masters/model/modelTable.vue").default,
    },
    {
        path: "/expensecategory",
        component: require("./components/admins/expense/expenseCategoryTable.vue").default,
    },
    {
        path: "/purchase",
        component: require("./components/admins/operations/purchase/purchaseTable.vue").default,
    },
    {
        path: "/vehicle-list",
        component: require("./components/admins/operations/vehicleList.vue").default,
    },
    {
        path: "/ready-vehicles",
        component: require("./components/admins/operations/readyVehicles.vue").default,
    },
    {
        path: "/booking-list",
        component: require("./components/admins/operations/booking/bookingList.vue").default,
    },
    {
        path: "/delivery-list",
        component: require("./components/admins/operations/deliveryList.vue").default,
    },
    {
        path: "/enquiry-list",
        component: require("./components/admins/leadManagement/enquiryList.vue").default,
    },
    {
        path: "/images",
        component: require("./components/admins/masters/image/imageMain.vue").default,
    },

 {
        path: "/purchase-report",
        component: require("./components/admins/reports/purchaseReport.vue").default,
    },
    {
        path: "/sales-report",
        component: require("./components/admins/reports/salesReport.vue").default,
    },

    {
        path: "/expense-report",
        component: require("./components/admins/reports/expenseReport.vue").default,
    },
];


const router = new VueRouter({
    // mode:'history',
    routes, // short for `routes: routes`
});








//MY-COMPONENTS

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

Vue.component(
    "navigation-sidebar",
    require("./components/admins/navigation.vue").default
);

Vue.component(
    "add-brand",
    require("./components/admins/masters/brand/addBrand.vue").default
);

Vue.component(
    "add-model",
    require("./components/admins/masters/model/addModel.vue").default
);
Vue.component(
    "add-expensecategory",
    require("./components/admins/expense/addExpenseCategory.vue").default
);

Vue.component(
    "expense-history",
    require("./components/admins/expense/expenseHistory.vue").default
);
Vue.component(
    "add-expense",
    require("./components/admins/expense/addExpense.vue").default
);
Vue.component(
    "ready-to-sell",
    require("./components/admins/operations/readyToSell.vue").default
);
Vue.component(
    "add-payment",
    require("./components/admins/operations/booking/addPayment.vue").default
);
Vue.component(
    "add-call-entry",
    require("./components/admins/leadManagement/addCallEntry.vue").default
);
Vue.component(
    "follow-up-history",
    require("./components/admins/leadManagement/followUpHistory.vue").default
);
Vue.component(
    "add-convertion",
    require("./components/admins/leadManagement/addConvertion.vue").default
);
Vue.component(
    "add-purchase",
    require("./components/admins/operations/purchase/addPurchase.vue").default
);

Vue.component(
    "payment-history",
    require("./components/admins/operations/booking/paymentHistory.vue").default
);

Vue.component(
    "mark-as-sale",
    require("./components/admins/operations/booking/markAsSale.vue").default
);

Vue.component(
    "rc-transfer",
    require("./components/admins/operations/rcTransfer.vue").default
);

Vue.component(
    "add-new-lead",
    require("./components/admins/leadManagement/addNewLead.vue").default
);

Vue.component(
    "add-new-image",
    require("./components/admins/masters/image/addImage.vue").default
);

Vue.component(
    "index-page-cars",
    require("./components/users/indexPageCars.vue").default
);

Vue.component(
    "single-car-page",
    require("./components/users/singleCarPage.vue").default
);

Vue.component(
    "enquire-now",
    require("./components/users/enquireNow.vue").default
);

Vue.component(
    "all-cars-page",
    require("./components/users/allCarsPage.vue").default
);

Vue.component(
    "pre-loader",
    require("./components/admins/loading.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
});
