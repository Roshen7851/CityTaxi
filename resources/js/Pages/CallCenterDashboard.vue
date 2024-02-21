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
                <div class="col-span-4 bg-white p-6 rounded-lg shadow-lg">
                    <div class="justify-between flex">
                    <h3 class="text-lg font-medium"> Ride Request </h3>
                        <button @click="guestDataModal=true" class="border border-black  dark:bg-yellow-500 hover:bg-yellow-500  text-black text-sm font-bold py-2 px-4 rounded">Guest Data</button>
                    </div>

                    <div class="mt-4">
                        <label>Location</label>
                        <input id="pac-input" type="text"
                               v-model="startLocation" @input="updateStartLocation"
                               class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-md shadow-sm px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               data-type="google-autocomplete"/>

                        <!--                        <select class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-md shadow-sm px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">-->
                        <!--                            <option>Enter Location</option>-->
                        <!--                            <option>United States</option>-->
                        <!--                            <option>Canada</option>-->
                        <!--                            <option>Mexico</option>-->
                        <!--                        </select>-->

                    </div>

                    <div class="mt-4">
                        <label>Destination</label>
                        <input id="pac-input1" ref="pacInput" v-model="endLocation" @input="updateEndLocation"
                               type="text"
                               class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-md shadow-sm px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               data-type="google-autocomplete"/>
                    </div>

                    <div class="mt-4">
                        <div class="bg-amber-400" id="map" ref="map" style="height: 300px"></div>
                    </div>

                    <div class="mt-4">
                        <button @click="getDirections"
                                class="bg-black w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-white text-sm font-bold py-2 px-4 rounded">
                            Request a ride
                        </button>
                    </div>
                </div>


                <div v-if="ride.locationRequested" class="col-span-4 bg-white p-6 rounded-lg shadow-lg">
                    <div class="grid grid-cols-4 gap-4">
                        <div @click="selectType(1)"
                             :class="[ride.typeSelected==1?'bg-amber-400':'bg-amber-100']"
                             class="py-2 px-2  hover:bg-amber-400 hover:shadow-2xl border-black rounded-lg shadow-lg"
                             style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="w-16" src="../../assets/images/icons/moto.png">
                            <p class="text-xs">City Taxi Moto</p>
                            <p class="text-xs"><i class="fa-solid fa-user"></i> 1</p>
                        </div>

                        <div @click="selectType(2)" :class="[ride.typeSelected==2?'bg-amber-400':'bg-amber-100']"
                             class="py-2 px-2  hover:bg-amber-400 hover:shadow-2xl border-black rounded-lg shadow-lg "
                             style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="w-16" src="../../assets/images/icons/rickshaw-svgrepo-com.svg">
                            <p class="text-xs"> Tuk</p>
                            <p class="text-xs"><i class="fa-solid fa-user"></i> 3</p>
                        </div>

                        <div @click="selectType(3)" :class="[ride.typeSelected==3?'bg-amber-400':'bg-amber-100']"
                             class="py-2 px-2  hover:shadow-2xl border-black rounded-lg shadow-lg "
                             style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="w-16" src="../../assets/images/icons/car.png">
                            <p class="text-xs"> Zip</p>
                            <p class="text-xs"><i class="fa-solid fa-user"></i>4</p>
                        </div>

                        <div @click="selectType(4)" :class="[ride.typeSelected==4?'bg-amber-400':'bg-amber-100']"
                             class="py-2 px-2  hover:bg-amber-400 hover:shadow-2xl border-black rounded-lg shadow-lg "
                             style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="w-16" src="../../assets/images/icons/wagon.png">
                            <p class="text-xs">City Taxi XL</p>
                            <p class="text-xs"><i class="fa-solid fa-user"></i>6</p>
                        </div>
                    </div>

                    <div v-if="filteredDriverList" class="mt-6 h-[400px] overflow-y-auto">

                        <div :class="[ride.driverSelected==driver?'bg-amber-400 font-bold':'']"
                             @click="selectDriver(driver)" v-for="driver in filteredDriverList" :key="driver.id"
                             class="grid mb-3 shadow-lg grid-cols-12 px-2 py-2 border-yellow-500 border-2 rounded-lg">
                            <img :src="driver.profile_photo_url" class="w-12 col-span-2 rounded-full">
                            <div class="ml-2 mt-2 col-span-4">
                                <p class=" text-xs">{{ driver.name }}</p>
                                <rating-component :selected="ride.driverSelected==driver"
                                                  :rate="driver.rating"></rating-component>

                            </div>
                            <div class="text-right mt-2 col-span-6">
                                <p class="text-xs">Affordable compact ride</p>
                                <p class="text-xs">{{ driver.duration }} min away ({{ driver.distanceInKmText }})</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="ride.driverSelected" class="col-span-4 bg-white p-6 rounded-lg shadow-lg"
                     style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <h3 class="text-lg font-medium"> Ride Details </h3>

                    <div class="mt-4 grid grid-cols-6 justify-between">
                        <div class="col-span-1">
                            <img :src="ride.driverSelected.profile_photo_url" class="w-16 rounded-full">
                        </div>
                        <div class="col-span-2">
                            <p class="mt-2">{{ ride.driverSelected.name }}</p>
                            <rating-component :rate="ride.driverSelected.rating"></rating-component>
                        </div>
                        <div class="text-right col-span-3">
                            <p> {{ ride.driverSelected.vehicles[0].brand.title }} -
                                {{ ride.driverSelected.vehicles[0].model.title }}
                                ({{ ride.driverSelected.vehicles[0].manufactured_year }}) |
                                {{ ride.driverSelected.vehicles[0].color }}</p>
                            <p> {{ ride.driverSelected.vehicles[0].registration_number }} </p>
                            <p>{{ ride.driverSelected.vehicles[0].model.vehicle_type.passenger_count }} Passengers</p>
                        </div>
                    </div>

                    <hr class="mt-2 border border-gray-200">

                    <div class="grid grid-cols-3">
                        <div class="px-2 py-2 text-center">
                            <p>Distance</p>
                            <p class="font-bold">{{ distance }}</p>
                        </div>
                        <div class="px-2 py-2 text-center">
                            <p>Estimated Duration</p>
                            <p class="font-bold">{{ estimatedDuration }}</p>
                        </div>
                        <div class="px-2 py-2 text-center">
                            <p>Arrived At</p>
                            <p class="font-bold">{{ estimatedArrival }}</p>
                        </div>
                    </div>
                    <hr class="mt-2 border border-gray-200">

                    <div>
                        <div class="flex justify-between mt-2">
                            <p>Base Fare</p>
                            <p>Rs. {{ parseFloat(basePrice).toFixed(2) }}</p>
                        </div>
                        <div class="flex justify-between mt-2">
                            <p>Distance Fare</p>
                            <p>Rs. {{ parseFloat(distancePrice).toFixed(2) }} </p>
                        </div>

                        <div class="flex justify-between mt-2 font-bold">
                            <p>Total</p>
                            <p>Rs. {{ parseFloat(totalPrice).toFixed(2) }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4 bottom-0">
                        <button
                            class="border border-black w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-black text-sm font-bold py-2 px-4 rounded">
                            Cancel Ride
                        </button>
                        <button @click="startRide"
                                class="bg-black w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-white text-sm font-bold py-2 px-4 rounded">
                            Start Ride
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div  id="popup-modal" tabindex="-1" v-if="guestDataModal"
              class="bg-black bg-opacity-70 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <div class="p-4 md:p-5 text-center">

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Guest Details </h3>


                        <div>
                            <div class="text-left mt-2">
                                <div class="mt-4">
                                    <label>Name</label>
                                    <input type="text"
                                           v-model="guestDetails.name"
                                           class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-md shadow-sm px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                         />

                                </div>
                                <div class="mt-4">
                                    <label>Email</label>
                                    <input type="email"
                                           v-model="guestDetails.email"
                                           class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-md shadow-sm px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                         />

                                </div>
                                <div class="mt-4">
                                    <label>Phone</label>
                                    <input type="text"
                                           v-model="guestDetails.phone"
                                           class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-md shadow-sm px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                         />

                                </div>
                            </div>

                        </div>
                        <div class="text-center grid grid-cols-1">
                            <button @click="guestDataModal=false"
                                    data-modal-hide="popup-modal"
                                    type="button"
                                    class="text-white bg-green-600  mt-3 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm items-center px-2 py-2 text-center">
                                Confirm
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
        drivers: [],
        greeting:"Hello !",
    },
    setup(props) {
        const value = ref()
        const guestDataModal = ref(false)
        const user = computed(() => page.props.auth.user)
        const distance = ref('');
        const duration = ref('');

        const guestDetails = reactive({
            name:'',
            email:'',
            phone:''
        })

        const ride = reactive({
            locationRequested: false,
            typeSelected: false,
            driverSelected: false,
        })

        const basePrice = computed(() => {
            const price = ride.driverSelected.vehicles[0].model.vehicle_type.base_price
            ride.basePrice = price;
            return price;
        });

        const distancePrice = computed(() => {
            const price = (distanceValue.value - 1) * ride.driverSelected.vehicles[0].model.vehicle_type.price_per_km
            ride.distancePrice = price;
            return price;
        });

        const totalPrice = computed(() => {
            const price = (distanceValue.value - 1) * ride.driverSelected.vehicles[0].model.vehicle_type.price_per_km + ride.driverSelected.vehicles[0].model.vehicle_type.base_price
            ride.totalPrice = price;
            return price;
        });


        const getCurrentTime = () => {
            const now = new Date();
            return now;
        };

        const estimatedArrival = computed(() => {
            // Assuming you have a duration value
            const durationInMinutes = parseInt(duration.value);

            if (!isNaN(durationInMinutes)) {
                const currentTime = getCurrentTime();
                const estimatedArrivalTime = new Date(currentTime.getTime() + durationInMinutes * 60 * 1000);

                // Format the estimated arrival time
                const hours = estimatedArrivalTime.getHours();
                const minutes = estimatedArrivalTime.getMinutes();
                return `${hours}:${minutes}`;
            } else {
                return '';
            }
        });


        const startLocation = ref('');
        const endLocation = ref('');
        const map = ref(null);


        const updateStartLocation = () => {
            console.log('Updated startLocation:', startLocation.value);
        };

        const updateEndLocation = () => {
            console.log('Updated endLocation:', endLocation.value);
        };

        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();

        const getDirections = () => {
            map.value = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 7.8731, lng: 80.7718}, // Coordinates for Colombo, Sri Lanka
                zoom: 6,
            });

            directionsRenderer.setMap(map.value);
            calculateAndDisplayRoute(directionsService, directionsRenderer);
            ride.locationRequested = true;
        };


        const initMap = async () => {

            // Initialize the map
            map.value = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 7.8731, lng: 80.7718}, // Coordinates for Colombo, Sri Lanka
                zoom: 6,
            });

            directionsRenderer.setMap(map.value);
        };

        const distanceValue = ref(0);

        const calculateAndDisplayRoute = (directionsService, directionsRenderer) => {
            directionsService.route(
                {
                    origin: startLocation.value, // Point A
                    destination: endLocation.value, // Point B
                    travelMode: 'DRIVING',
                },
                (response, status) => {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(response);

                        // Get distance and duration
                        const route = response.routes[0];
                        const leg = route.legs[0];

                        const distanceInKm = leg.distance.text;
                        const durationInSeconds = leg.duration.value;

                        // Convert duration from seconds to a more human-readable format
                        const durationInMinutes = Math.floor(durationInSeconds / 60);
                        distance.value = distanceInKm;
                        distanceValue.value = leg.distance.value / 1000;
                        duration.value = durationInMinutes;

                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                }
            );
        }

        const autoComplete = ref(null);
        const autoComplete1 = ref(null);
        const initLocation = async () => {
            const pacInput = document.getElementById('pac-input');
            if (pacInput) {
                const options = {
                    componentRestrictions: {country: "LK"},
                    fields: ["address_components", "geometry", "icon", "name"],
                    strictBounds: false,
                };
                autoComplete.value = new google.maps.places.Autocomplete(pacInput, options);
                // Listen for the place_changed event
                autoComplete.value.addListener('place_changed', onPlaceChanged);
            } else {
                console.log('pacInput not found');
            }

        };

        const onPlaceChanged = () => {
            console.log('Place changed');
            const selectedPlace = autoComplete.value.getPlace();
            startLocation.value = selectedPlace.name || '';

            // You can do additional processing or emit events if needed
            console.log('Selected Place:', selectedPlace);
            console.log('Selected Place:', startLocation.value);

        };


        const initDestination = async () => {
            const pacInput = document.getElementById('pac-input1');
            if (pacInput) {

                const options = {
                    componentRestrictions: {country: "LK"},
                    fields: ["address_components", "geometry", "icon", "name"],
                    strictBounds: false,
                };
                autoComplete1.value = new google.maps.places.Autocomplete(pacInput, options);
                // Listen for the place_changed event
                autoComplete1.value.addListener('place_changed', onDestinationChanged);
            } else {
                console.log('pacInput not found');
            }
        };

        const onDestinationChanged = () => {
            console.log('Destination changed');
            const selectedPlace = autoComplete1.value.getPlace();
            endLocation.value = selectedPlace.name || '';

            // You can do additional processing or emit events if needed
            console.log('Selected Place:', selectedPlace);
            console.log('Selected Place:', endLocation.value);

        };

        onMounted(() => {
            // Initialize the map when the component is mounted
            initMap();
            initLocation();
            initDestination();


        });

        const estimatedDuration = computed(() => {
            const durationInMinutes = parseInt(duration.value);

            if (!isNaN(durationInMinutes)) {
                if (durationInMinutes < 60) {
                    return `${durationInMinutes} minutes`;
                } else {
                    const hours = Math.floor(durationInMinutes / 60);
                    const remainingMinutes = durationInMinutes % 60;
                    return `${hours} hours ${remainingMinutes} minutes`;
                }
            } else {
                return '';
            }
        });

        const selectType = (type) => {
            ride.typeSelected = type;
            ride.driverSelected = false;
            driverList();
        }

        const filteredDriverList = ref([]);


        const getDistanceAndDuration = (startLocation, driverLocation) => {
            return new Promise((resolve, reject) => {
                directionsService.route(
                    {
                        origin: driverLocation,
                        destination: startLocation,
                        travelMode: 'DRIVING',
                    },
                    (response, status) => {
                        if (status === 'OK') {
                            const route = response.routes[0];
                            const leg = route.legs[0];

                            const distanceInKm = leg.distance.value / 1000;
                            const distanceInKmText = leg.distance.text;
                            const durationInSeconds = leg.duration.text;

                            resolve({distanceInKm, durationInSeconds, distanceInKmText});
                        } else {
                            reject(new Error('Directions request failed due to ' + status));
                        }
                    }
                );
            });
        }


        const driverList = async () => {
            // empty the driver list
            filteredDriverList.value = [];

            const filteredDrivers = props.drivers.filter(function (driver) {
                console.log(driver)
                const driverType = driver.vehicles[0].model.vehicle_type_id;
                return driverType === ride.typeSelected;
            });


            for (let i = 0; i < filteredDrivers.length; i++) {
                const driver = filteredDrivers[i];
                const driverLocation = driver.address;

                try {
                    const result = await getDistanceAndDuration(driverLocation, startLocation.value);

                    if (result.distanceInKm < 10) {
                        driver.distance = result.distanceInKm;
                        driver.distanceInKmText = result.distanceInKmText;
                        driver.duration = result.durationInSeconds;
                        filteredDriverList.value.push(driver);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            console.log('Filtered Drivers:', filteredDriverList.value);
        };

        const selectDriver = (driver) => {
            ride.driverSelected = driver;
        }

        const startRide = () => {
            if (guestDetails.name ==''){
                alert("Please Fill Guest Data");
                return
            }

            router.post('/ride', {
                start_location: startLocation.value,
                end_location: endLocation.value,
                driver: ride.driverSelected,
                distance: distance.value,
                duration: estimatedDuration.value,
                price: totalPrice.value,
                vehicle_id: ride.driverSelected.vehicles[0].id,
                passenger_id: user.value.id,
                arrived_at: estimatedArrival.value,
                base_fare: parseFloat(basePrice.value).toFixed(2),
                distance_fare: parseFloat(distancePrice.value).toFixed(2),
                total: parseFloat(totalPrice.value).toFixed(2),
                guest_data:guestDetails
            });
        }

        return {
            value,
            user,
            startLocation,
            endLocation,
            map,
            updateStartLocation,
            updateEndLocation,
            getDirections,
            estimatedArrival,
            distance,
            estimatedDuration,
            ride,
            selectType,
            filteredDriverList,
            selectDriver,
            distanceValue,
            basePrice,
            distancePrice,
            totalPrice,
            startRide,
            guestDataModal,
            guestDetails
        }
    }
}

</script>
