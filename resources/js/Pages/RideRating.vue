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


                </div>
            </div>
        </div>

        <div id="popup-modal" tabindex="-1" v-if="modalState"
             class="bg-black bg-opacity-70 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" @click="modalState=false"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal">


                    </button>
                    <div class="p-4 md:p-5 ">

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">How was your journey ? </h3>
                        <div class="mt-4 grid grid-cols-6 justify-between"><div class="col-span-1">
                            <img :src="driver.profile_photo_url"  class="w-16 rounded-full"></div>
                            <div class="col-span-2"><p class="mt-2">{{driver.name}}</p>
                            </div><div class="text-right col-span-3"><p>{{vehicleModel.title}} - {{vehicleBrand.title}} ({{vehicle.manufactured_year}}) | {{vehicle.color}} </p><p> AB-9878 </p><p>4 Passengers</p></div></div>
                        <hr class="mt-6">


                        <div class=" grid grid-cols-1 mt-4">
                            <label>Rate your experience  {{ratingScore}}</label>
                            <rating-component @rating-selected="handleRatingSelection"  :rate="ratingScore"></rating-component>

                            <label class="mt-5">comment (optional)</label>
                            <textarea v-model="comment" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-md shadow-sm px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            ></textarea>

                        </div>

                        <div class="text-center grid grid-cols-2 gap-4 mt-4">
                            <button @click="modalState=false" data-modal-hide="popup-modal" type="button"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancel
                            </button>

                            <button @click="rateNow" data-modal-hide="popup-modal" type="button"
                                    class="text-white bg-black hover:bg-red-800 ml-2 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                Rate and comment
                            </button>
                        </div>



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
        const modalState = ref(true);
        const value = ref()
        const user = computed(() => page.props.auth.user)

        const startLocation = ref('');
        const endLocation = ref('');
        const map = ref(null);

        const comment = ref('')
        const ratingScore = ref(0)

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

        const rateNow = () =>{
            router.post('/rate-now', {
                ride_id: props.ride.id,
                rating_score: ratingScore.value,
                comment: comment.value,
                driver_id: props.driver.id,
                passenger_id :props.ride.passenger_id
            });
        }

        const handleRatingSelection =(rating) =>{
            ratingScore.value = rating
            console.log(rating)
        }

        return {
            value,
            user,
            startLocation,
            endLocation,
            map,
            getDirections,
            cancelRide,
            payNow,
            comment,
            ratingScore,
            modalState,
            rateNow,
            handleRatingSelection
        }
    }
}

</script>
