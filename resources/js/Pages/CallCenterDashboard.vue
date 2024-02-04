<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
               Call Center Dashboard
            </h2>
        </template>

        <div class="py-12 p-6">
            <div class="grid grid-cols-12 gap-4">
                <div class="card grid grid-cols-4 space-x-4 p-3 bg-white col-span-4 shadow-lg rounded-lg">
                    <div class="col-span-3">
                        <p class="font-bold text-lg tracking-wide text-slate-700 dark:text-navy-100">
                            Good Morning !
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

            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import {computed, onMounted, ref} from "vue";
import {usePage} from "@inertiajs/vue3";

const page = usePage()

export default {
    components: {
        AppLayout
    },
    setup() {
        const value = ref()
        const user = computed(() => page.props.auth.user)
        const distance = ref('');
        const duration = ref('');

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
                center: { lat: 7.8731, lng: 80.7718 }, // Coordinates for Colombo, Sri Lanka
                zoom: 6,
            });

            directionsRenderer.setMap(map.value);
            calculateAndDisplayRoute(directionsService, directionsRenderer);
        };


        const initMap = async () => {

            // Initialize the map
            map.value = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 7.8731, lng: 80.7718 }, // Coordinates for Colombo, Sri Lanka
                zoom: 6,
            });

            directionsRenderer.setMap(map.value);
        };

        const calculateAndDisplayRoute = (directionsService, directionsRenderer) => {
            directionsService.route(
                {
                    origin:  startLocation.value, // Point A
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
                        duration.value = durationInMinutes;

                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                }
            );
        }

        const autoComplete = ref(null);
        const autoComplete1= ref(null);
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
            // Assuming you have a duration value
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
        }
    }
}

</script>
