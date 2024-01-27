<script setup xmlns="http://www.w3.org/1999/html">
import {Head, Link} from '@inertiajs/vue3';
import {ref} from "vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const mobileMenu = ref(false);

const toggleMobileMenu = () => {
    mobileMenu.value = !mobileMenu.value;
}
</script>

<template>
    <Head title="Welcome"/>

    <div class="container mx-auto h-screen">
        <div class=" bg-transparent mx-auto">
            <nav class="bg-transparent flex justify-between items-center py-3">
                <a class="text-3xl font-semibold leading-none" href="/">
                    <img class="h-10" src="../../assets/images/logo.svg" alt="">
                </a>
                <div class="md:hidden" @click="toggleMobileMenu">
                    <button id="mobile-menu-button" class="focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

                <div class="hidden md:block">
                    <a class="dark:text-white text-sm font-semibold leading-none hover:bg-yellow-500 px-2 py-2 rounded hover:text-white" href="/login">
                        Login
                    </a>

                    <a class="dark:text-white text-sm font-semibold leading-none hover:bg-yellow-500 px-2 py-2 rounded hover:text-white" href="/register">
                        Register as passenger
                    </a>

                    <a class="dark:text-white text-sm leading-none underline font-bold hover:bg-yellow-500 px-2 py-2 rounded hover:text-white" href="/register-driver">
                        Register as driver
                    </a>
                </div>



                <div id="mobile-menu" class="md:hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-85" v-if="mobileMenu">
                    <div class="flex justify-end p-4">
                        <button class="text-white text-2xl" @click="mobileMenu = false">&times;</button>
                    </div>
                    <div class="flex flex-col items-center">
                        <a class="text-white block text-sm font-semibold leading-none hover:bg-yellow-500 px-2 py-2 rounded hover:text-white" href="/login">
                            Login
                        </a>
                        <a class="text-white block text-sm font-semibold leading-none hover:bg-yellow-500 px-2 py-2 rounded hover:text-white" href="/register">
                            Register as passenger
                        </a>
                        <a class="text-white block text-sm leading-none underline font-bold hover:bg-yellow-500 px-2 py-2 rounded hover:text-white" href="/register-driver">
                            Register as driver
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="flex items-center justify-center mt-2 lg:mt-16 xl:mt-32">
            <div class="w-full sm:w-1/2 px-3">
                <div class="max-w-lg sm:max-w-md mx-auto lg:mx-0 mb-8">
                    <h2 class="text-3xl lg:text-4xl font-bold font-heading dark:text-white">
                        Find a <span class="text-blue-500 font-extrabold">Secure Ride</span>,
                    </h2>
                    <h3 class="text-3xl lg:text-4xl mb-4 font-bold font-heading dark:text-white">
                        When you want, at the right price.
                    </h3>
                    <p class="dark:text-white">Request a ride, hop in, and go.</p>

                    <select class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-md shadow-sm px-4 py-2 mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Enter Location</option>
                        <option>United States</option>
                        <option>Canada</option>
                        <option>Mexico</option>
                    </select>

                    <select class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 rounded-md shadow-sm px-4 py-2 mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Enter Destination</option>
                        <option>United States</option>
                        <option>Canada</option>
                        <option>Mexico</option>
                    </select>

                    <button class="bg-black dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-white text-sm font-bold py-2 px-4 rounded">
                        Request a ride
                    </button>
                </div>
            </div>
            <div class="hidden sm:block sm:w-1/2 px-3 lg:bg-blueGray-10 mb-12 lg:mb-0 pb-10">
                <div class="flex items-center justify-center">
                    <img src="../../assets/images/landing2.svg"  alt="Landing Image">
                </div>
            </div>
        </div>
    </div>



</template>


<style scoped>

</style>
