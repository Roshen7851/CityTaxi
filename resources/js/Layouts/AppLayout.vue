<script setup>
import {computed, ref} from 'vue';
import {Head, Link, router, usePage} from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
const page = usePage()
const role = computed(() => page.props.auth.role)
const userRole = role.value[0];
defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title"/>

        <div class="flex">
            <div>
                <nav class="lg:hidden py-6 px-6 border-b">
                    <div class="flex items-center justify-between">
                        <a class="text-2xl font-semibold" href="#">
                            <img class="h-10" src="../../assets/images/logo.svg" alt="" width="auto">
                        </a>
                        <button class="navbar-burger flex items-center rounded focus:outline-none">
                            <svg class="text-white bg-yellow-5000 hover:bg-indigo-600 block h-8 w-8 p-2 rounded"
                                 viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <title>Mobile menu</title>
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                            </svg>
                        </button>
                    </div>
                </nav>

                <div class="hidden lg:block navbar-menu relative z-50">
                    <div class="navbar-backdrop fixed lg:hidden inset-0 bg-gray-800 opacity-10"></div>
                    <nav
                        class="fixed bg-black rounded-3xl  top-0 left-0 bottom-0 flex flex-col w-3/4 lg:w-80 sm:max-w-xs pt-6 pb-8  border-r overflow-y-auto">
                        <div class="flex w-full items-center px-6 pb-6 mb-6 lg:border-b border-blue-50">
                            <a class="text-xl font-semibold" href="#">
                                <img class="" src="../../assets/images/Logo/dark_mode_1.png" alt="" width="auto">
                            </a>
                        </div>

                        <div class="px-4 pb-6">
                            <ul class="mb-8 text-sm font-medium">


                                <li v-if="userRole=='user'">
                                    <a :class="[route().current()=='user.dashboard' ?'bg-yellow-500':'']" class="flex items-center pl-3 py-3 pr-2 text-gray-500 hover:bg-yellow-500 rounded"
                                       href="/user-dashboard">
              <span class="inline-block mr-3 text-white text-lg">
               <i class="fa-solid fa-globe"></i>
              </span>
                                        <span class="font-bold text-white">Dashboard </span>
                                    </a>
                                </li>

                                <li v-else-if="userRole=='driver'">
                                    <a :class="[route().current()=='driver.dashboard' ?'bg-yellow-500':'']" class="flex items-center pl-3 py-3 pr-2 text-gray-500 hover:bg-yellow-500 rounded"
                                       href="/driver-dashboard">
              <span class="inline-block mr-3 text-white text-lg">
               <i class="fa-solid fa-globe"></i>
              </span>
                                        <span class="font-bold text-white">Dashboard </span>
                                    </a>
                                </li>

                                <li v-else-if="userRole=='call_center'">
                                    <a :class="[route().current()=='call_center.dashboard' ?'bg-yellow-500':'']" class="flex items-center pl-3 py-3 pr-2 text-gray-500 hover:bg-yellow-500 rounded"
                                       href="/call-center-dashboard">
              <span class="inline-block mr-3 text-white text-lg">
               <i class="fa-solid fa-globe"></i>
              </span>
                                        <span class="font-bold text-white">Dashboard  </span>
                                    </a>
                                </li>

                                <li v-else-if="userRole=='admin'">
                                    <a :class="[route().current()=='admin.dashboard' ?'bg-yellow-500':'']" class="flex items-center pl-3 py-3 pr-2 text-gray-500 hover:bg-yellow-500 rounded"
                                       href="/admin-dashboard">
              <span class="inline-block mr-3 text-white text-lg">
               <i class="fa-solid fa-globe"></i>
              </span>
                                        <span class="font-bold text-white">Dashboard </span>
                                    </a>
                                </li>



                                <li>
                                    <a :class="[route().current()=='ride.list' ?'bg-yellow-500':'']" class="flex items-center pl-3 py-3 pr-2 text-gray-500  rounded"
                                       href="/ride-list">
             <span class="inline-block mr-3 text-white text-lg">
                <i class="fa-solid fa-car-side"></i>
              </span>
                                        <span class="font-bold text-white">Trips</span>
                                    </a>
                                </li>


<!--                                <li>-->
<!--                                    <a class="flex items-center pl-3 py-3 pr-2 text-gray-500 hover:bg-yellow-500 rounded"-->
<!--                                       href="#">-->
<!--              <span class="inline-block mr-3 text-white text-lg">-->
<!--                <i class="fa-solid fa-comments"></i>-->
<!--              </span>-->
<!--                                        <span class="font-bold text-white">Chats</span>-->
<!--                                    </a>-->
<!--                                </li>-->


                            </ul>

                            <div class="pt-8">
                                <a class="flex items-center pl-3 py-3 pr-2 text-gray-500 hover:bg-yellow-500 rounded"
                                   href="#">
          <span class="inline-block mr-3 text-white text-lg">
          <i class="fa-solid fa-gear"></i>
            </span>
                                    <span class="font-bold text-white">Settings</span>
                                </a>
                                <a @click.prevent="logout" class="flex items-center pl-3 py-3 pr-2 text-gray-500 hover:bg-yellow-500 rounded"
                                   >
             <span class="inline-block mr-3 text-white text-lg">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </span>
                                    <span class="font-bold text-white">Log Out</span>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="mx-auto lg:ml-80"></div>
            </div>

            <div class="min-h-screen bg-gray-100 dark:bg-gray-900 w-full">
                <header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl  py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header"/>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="">
                    <slot/>
                </main>
            </div>
        </div>


    </div>
</template>
