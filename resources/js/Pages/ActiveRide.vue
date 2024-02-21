<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12 p-6">
            <div class="grid grid-cols-12 gap-4">
                <div class="card grid grid-cols-4 space-x-4 p-3 bg-white col-span-4 shadow-lg rounded-lg">
                    <div class="col-span-3">
                        <p class="font-bold text-lg tracking-wide text-slate-700 dark:text-navy-100">
                            {{greeting}}
                        </p>
                        <p class="mt-2 text-xs+">
                            Welcome back {{ user.name }}, Lets ride with City Taxi
                        </p>

                    </div>
                    <div class=" mt-3">
                        <img class="w-full" src="../../assets/images/landing3.svg" alt="image">
                    </div>
                </div>

                <div class="col-span-8 bg-white p-6 rounded-lg shadow-lg text-right">
                    <p class="text-lg font-bold">City Taxi XL: economy rides for groups up to 6</p>
                    <p>If you're in a group of up to 8 people,have a lot of luggage or groceries, or just want to bigger
                        car, you can choose City Taxy Xl for a ride in a minivan or SUV</p>
                </div>
            </div>

            <div class="grid grid-cols-12 mt-6 gap-4">
                <div class="col-span-8 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-medium"> Active Ride </h3>


                    <div class="mt-4">
                        <div class="bg-amber-400" id="map" ref="map" style="height: 500px"></div>
                    </div>


                </div>


                <div  class="col-span-4 bg-white p-6 rounded-lg shadow-lg"
                     style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <h3 class="text-lg font-medium"> Ride Details </h3>

                    <div class="mt-4 grid grid-cols-6 justify-between">
                        <div class="col-span-1">
                            <img :src="driver.profile_photo_url" class="w-16 rounded-full">
                        </div>
                        <div class="col-span-2">
                            <p class="mt-2">{{driver.name}}</p>
                            <rating-component :rate="driver.rating"></rating-component>
                        </div>
                        <div class="text-right col-span-3">
                            <p> {{vehicleModel.title}} - {{vehicleBrand.title}} ({{vehicle.manufactured_year}}) | {{vehicle.color}} </p>
                            <p> {{vehicle.registration_number}} </p>
                            <p>{{vehicleType.passenger_count}} Passengers</p>
                        </div>
                    </div>

                    <hr class="mt-2 border border-gray-200">

                    <div class="grid grid-cols-3">
                        <div class="px-2 py-2 text-center">
                            <p>Distance</p>
                            <p class="font-bold">{{ride.distance}}</p>
                        </div>
                        <div class="px-2 py-2 text-center">
                            <p>Estimated Duration</p>
                            <p class="font-bold">{{ride.duration}}</p>
                        </div>
                        <div class="px-2 py-2 text-center">
                            <p>Arrived At</p>
                            <p class="font-bold">{{ride.arrived_at}}</p>
                        </div>
                    </div>
                    <hr class="mt-2 border border-gray-200">

                    <div>
                        <div class="flex justify-between mt-2">
                            <p>Base Fare</p>
                            <p>Rs. {{parseFloat(ride.base_fare).toFixed(2)}}</p>
                        </div>
                        <div class="flex justify-between mt-2">
                            <p>Distance Fare</p>
                            <p>Rs. {{parseFloat(ride.distance_fare).toFixed(2)}} </p>
                        </div>

                        <div class="flex justify-between mt-2 font-bold">
                            <p>Total</p>
                            <p>Rs. {{parseFloat(ride.total).toFixed(2)}}</p>
                        </div>
                    </div>


                    <div v-if="role=='user'" class="grid grid-cols-1 gap-4 mt-4 bottom-0">
                        <button @click="cancelRide"
                            class="border bg-red-600 w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-white text-sm font-bold py-2 px-4 rounded">
                            Cancel Ride
                        </button>
                    </div>
                    <div v-else-if="role=='driver'" class="grid grid-cols-1 gap-4 mt-4 bottom-0">
                        <button @click="requestPayment"
                            class="border bg-green-600 w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-white text-sm font-bold py-2 px-4 rounded">
                           Completed ! Request For Payment
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div  id="popup-modal" tabindex="-1" v-if="modalState"
             class="bg-black bg-opacity-70 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <div class="p-4 md:p-5 text-center">

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Wow ! Hope You Enjoy with Ride. Please Make a Payment to Driver </h3>
                        <div class="mt-4 grid grid-cols-6 justify-between"><div class="col-span-1">
                            <img :src="driver.profile_photo_url"  class="w-16 rounded-full"></div>
                            <div class="col-span-2"><p class="mt-2">{{driver.name}}</p>
                            </div><div class="text-right col-span-3"><p>{{vehicleModel.title}} - {{vehicleBrand.title}} ({{vehicle.manufactured_year}}) | {{vehicle.color}} </p><p> AB-9878 </p><p>4 Passengers</p></div></div>
                        <hr class="mt-6">
                        <div class="grid grid-cols-3 mt-6">
                            <div class="px-2 py-2 text-center"><p>Distance</p><p class="font-bold">{{ride.distance}}</p></div><div class="px-2 py-2 text-center"><p>Estimated Duration</p><p class="font-bold">{{ride.duration}}</p></div><div class="px-2 py-2 text-center"><p>Arrived At</p><p class="font-bold">{{ride.arrived_at}}</p></div></div>
                        <hr class="mt-6">

                        <div>
                            <div class="flex justify-between mt-2">
                                <p>Base Fare</p>
                                <p>Rs. {{parseFloat(ride.base_fare).toFixed(2)}}</p>
                            </div>
                            <div class="flex justify-between mt-2">
                                <p>Distance Fare</p>
                                <p>Rs. {{parseFloat(ride.distance_fare).toFixed(2)}} </p>
                            </div>

                            <div class="flex justify-between mt-2 font-bold">
                                <p>Total</p>
                                <p>Rs. {{parseFloat(ride.total).toFixed(2)}}</p>
                            </div>
                        </div>
                        <div class="text-center grid grid-cols-1">
                            <button @click="payNow"
                                data-modal-hide="popup-modal"
                                type="button"
                                class="text-white bg-green-600  mt-3 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm items-center px-2 py-2 text-center">
                                Pay now
                            </button>
                        </div>



                    </div>
                </div>
            </div>
        </div>

        <div  id="popup-modal" tabindex="-1" v-if="waitingModalState"
             class="bg-black bg-opacity-70 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <div class="p-4 md:p-5 text-center">

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Waiting For Payment... </h3>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import {computed, onMounted, reactive, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import RatingComponent from "@/Components/RatingComponent.vue";

const page = usePage()
const modalState = ref(false)



export default {
    components: {
        RatingComponent,
        AppLayout
    },
    props: {
        driver: {},
        ride:{},
        vehicle:{},
        vehicleModel:{},
        vehicleBrand:{},
        vehicleType:{},
        greeting:"Hello !",
    },
    setup(props) {
        const value = ref()
        const user = computed(() => page.props.auth.user)
        const role = computed(() => page.props.auth.role)


        const startLocation = ref('');
        const waitingModalState = ref(false);
        const endLocation = ref('');
        const map = ref(null);

        const initPusher =()=>{
            const pusher = new Pusher('33bd000ba183c7a15acd', {
                cluster: 'ap2'
            });

            var passengerId = 0
            if (page.props){
                passengerId = page.props.auth.user.id
            }

            console.log(passengerId);
            const channel = pusher.subscribe('ride-end.' + passengerId)
            const channel2 = pusher.subscribe('payment-done.' + passengerId)

            channel.bind('ride-end-event', function (data) {
                modalState.value = true
            });

            channel2.bind('payment-done-event', function (data) {
                console.log('payment-done-event')
                waitingModalState.value = false
                router.get('/ride-list');
            });
        }


        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();

        const getDirections = () => {
            map.value = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 7.8731, lng: 80.7718}, // Coordinates for Colombo, Sri Lanka
                zoom: 6,
            });

            directionsRenderer.setMap(map.value);
            calculateAndDisplayRoute(directionsService, directionsRenderer);
        };


        const initMap = async () => {

            // Initialize the map
            map.value = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 7.8731, lng: 80.7718}, // Coordinates for Colombo, Sri Lanka
                zoom: 6,
            });

            directionsRenderer.setMap(map.value);
            calculateAndDisplayRoute(directionsService, directionsRenderer);
        };


        const calculateAndDisplayRoute = (directionsService, directionsRenderer) => {
            directionsService.route(
                {
                    origin: props.ride.start_location, // Point A
                    destination:  props.ride.end_location, // Point B
                    travelMode: 'DRIVING',
                },
                (response, status) => {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(response);

                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                }
            );
        }


        onMounted(() => {
            initMap();
            initPusher();
        });


        const cancelRide =()=>{
            router.post('/cancel-ride', {
                ride_id: props.ride.id,
            });
        }

        const payNow = () =>{
            router.post('/ride-payment', {
                ride_id: props.ride.id,
            });
        }

        const requestPayment = () =>{
            router.post('/ride-request-payment', {
                ride_id: props.ride.id,
            });
            waitingModalState.value =true
        }

        return {
            value,
            user,
            startLocation,
            endLocation,
            map,
            getDirections,
            cancelRide,
            modalState,
            payNow,
            role,
            requestPayment,
            waitingModalState
        }
    }
}

</script>
