import GetSenderParcels from './components/GetSenderParcels.vue';
import CreateParcel from './components/CreateParcel.vue';
import SenderLogin from "./components/SenderLogin.vue";
import BikerLogin from "./components/BikerLogin.vue";
import BikerParcels from "./components/BikerParcels.vue";
import BikerPickParcel from "./components/BikerPickParcel.vue";
import showSenderParcel from "./components/showSenderParcel.vue";
import BikerListDropOffParcels from "./components/BikerListDropOffParcels.vue";
import BikerDropOffParcel from "./components/BikerDropOffParcel.vue";
import HomePage from "./HomePage.vue";
export const routes = [
    {
        path: "/bikers/login",
        name: "BikerLogin",
        component: BikerLogin,
    },
    {
        path: "/bikers/parcels",
        name: "bikerParcels",
        component: BikerParcels,
    },
    {
        path: "/bikers/parcels/pick:id",
        name: "bikerPickParcel",
        component: BikerPickParcel,
    },
    {
        path: "/bikers/parcels",
        name: "bikerListDropOffParcel",
        component: BikerListDropOffParcels,
    },
    {
        path: "/bikers/parcels/drop-off:id",
        name: "bikerDropOffParcel",
        component: BikerDropOffParcel,
    },
    {
        path: "/senders/login",
        name: "SenderLogin",
        component: SenderLogin,
    },
    {
        path: '/senders/parcels',
        name: 'senderParcels',
        component: GetSenderParcels
    }, {
        path: '/senders/parcels/:id',
        name: 'parcelSenderDetails',
        component: showSenderParcel
    },
    {
        path: '/parcels/create',
        name: 'createParcel',
        component: CreateParcel
    },{
        path: '/',
        name: 'homePage',
        component: HomePage
    },
];
