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
                <div class="col-span-4 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-medium"> Ride Request </h3>

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
                                            <button @click="getDirections" class="bg-black w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-white text-sm font-bold py-2 px-4 rounded">
                                                Request a ride
                                            </button>
                                        </div>
                </div>


                <div class="col-span-4 bg-white p-6 rounded-lg shadow-lg">
                    <div class="grid grid-cols-4 gap-4">
                        <div
                            class="py-2 px-2  hover:bg-amber-400 hover:shadow-2xl border-black rounded-lg shadow-lg bg-amber-100"
                            style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="w-16" src="../../assets/images/icons/moto.png">
                            <p class="text-xs">City Taxi Moto</p>
                            <p class="text-xs"><i class="fa-solid fa-user"></i> 1</p>
                        </div>

                        <div
                            class="py-2 px-2  hover:bg-amber-400 hover:shadow-2xl border-black rounded-lg shadow-lg bg-amber-100"
                            style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="w-16" src="../../assets/images/icons/rickshaw-svgrepo-com.svg">
                            <p class="text-xs"> Tuk</p>
                            <p class="text-xs"><i class="fa-solid fa-user"></i> 3</p>
                        </div>

                        <div class="py-2 px-2  bg-amber-400 hover:shadow-2xl border-black rounded-lg shadow-lg "
                             style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="w-16" src="../../assets/images/icons/car.png">
                            <p class="text-xs"> Zip</p>
                            <p class="text-xs"><i class="fa-solid fa-user"></i>4</p>
                        </div>

                        <div
                            class="py-2 px-2  hover:bg-amber-400 hover:shadow-2xl border-black rounded-lg shadow-lg bg-amber-100"
                            style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="w-16" src="../../assets/images/icons/wagon.png">
                            <p class="text-xs">City Taxi XL</p>
                            <p class="text-xs"><i class="fa-solid fa-user"></i>6</p>
                        </div>
                    </div>

                    <div class="mt-6 h-[400px] overflow-y-auto">
                        <div class="grid mb-3 shadow-lg grid-cols-12 px-2 py-2 border-yellow-500 border-2 rounded-lg">
                            <img src="https://i.pravatar.cc/150?img=1" class="w-12 col-span-2 rounded-full">
                            <div class="ml-2 mt-2 col-span-4">
                                <p class=" text-xs">Nishan Lanka</p>
                                <div class="flex">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                </div>

                            </div>
                            <div class="text-right mt-2 col-span-6">
                                <p class="text-xs">Affordable compact ride</p>
                                <p class="text-xs">6min away</p>
                            </div>
                        </div>
                        <div
                            class="grid mb-3 bg-amber-400 shadow-lg grid-cols-12 px-2 py-2 border-yellow-500 border-2 rounded-lg">
                            <img src="https://i.pravatar.cc/150?img=8" class="w-12 col-span-2 rounded-full">
                            <div class="ml-2 mt-2 col-span-4">
                                <p class=" text-xs">CK Pawan</p>
                                <div class="flex">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                </div>

                            </div>
                            <div class="text-right mt-2 col-span-6">
                                <p class="text-xs">Affordable compact ride</p>
                                <p class="text-xs">6min away</p>
                            </div>
                        </div>
                        <div class="grid mb-3 shadow-lg grid-cols-12 px-2 py-2 border-yellow-500 border-2 rounded-lg">
                            <img src="https://i.pravatar.cc/150?img=3" class="w-12 col-span-2 rounded-full">
                            <div class="ml-2 mt-2 col-span-4">
                                <p class=" text-xs">Ushan K</p>
                                <div class="flex">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                </div>

                            </div>
                            <div class="text-right mt-2 col-span-6">
                                <p class="text-xs">Affordable compact ride</p>
                                <p class="text-xs">6min away</p>
                            </div>
                        </div>
                        <div class="grid mb-3 shadow-lg grid-cols-12 px-2 py-2 border-yellow-500 border-2 rounded-lg">
                            <img src="https://i.pravatar.cc/150?img=9" class="w-12 col-span-2 rounded-full">
                            <div class="ml-2 mt-2 col-span-4">
                                <p class=" text-xs">Kumara manel</p>
                                <div class="flex">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                </div>

                            </div>
                            <div class="text-right mt-2 col-span-6">
                                <p class="text-xs">Affordable compact ride</p>
                                <p class="text-xs">6min away</p>
                            </div>
                        </div>
                        <div class="grid mb-3 shadow-lg grid-cols-12 px-2 py-2 border-yellow-500 border-2 rounded-lg">
                            <img src="https://i.pravatar.cc/150?img=10" class="w-12 col-span-2 rounded-full">
                            <div class="ml-2 mt-2 col-span-4">
                                <p class=" text-xs">Vishak Balasooriya</p>
                                <div class="flex">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                </div>

                            </div>
                            <div class="text-right mt-2 col-span-6">
                                <p class="text-xs">Affordable compact ride</p>
                                <p class="text-xs">6min away</p>
                            </div>
                        </div>
                        <div class="grid mb-3 shadow-lg grid-cols-12 px-2 py-2 border-yellow-500 border-2 rounded-lg">
                            <img src="https://i.pravatar.cc/150?img=8" class="w-12 col-span-2 rounded-full">
                            <div class="ml-2 mt-2 col-span-4">
                                <p class=" text-xs">CK Pawan</p>
                                <div class="flex">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                </div>

                            </div>
                            <div class="text-right mt-2 col-span-6">
                                <p class="text-xs">Affordable compact ride</p>
                                <p class="text-xs">6min away</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-4 bg-white p-6 rounded-lg shadow-lg"
                     style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <h3 class="text-lg font-medium"> Ride Details </h3>

                    <div class="mt-4 grid grid-cols-6 justify-between">
                        <div class="col-span-1">
                            <img src="https://i.pravatar.cc/150?img=8" class="w-16 rounded-full">
                        </div>
                        <div class="col-span-2">
                            <p class="mt-2">CK Pawan</p>
                            <div class="flex">
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="text-right col-span-3">
                            <p>Wagon R - Red </p>
                            <p>ABC-2929</p>
                            <p>4 Passengers</p>
                        </div>
                    </div>

                    <hr class="mt-2 border border-gray-200">

                    <div class="grid grid-cols-3">
                        <div class="px-2 py-2 text-center">
                            <p>Distance</p>
                            <p class="font-bold">{{distance}}</p>
                        </div>
                        <div class="px-2 py-2 text-center">
                            <p>Estimated Duration</p>
                            <p class="font-bold">{{estimatedDuration}}</p>
                        </div>
                        <div class="px-2 py-2 text-center">
                            <p>Arrived At</p>
                            <p class="font-bold">{{estimatedArrival}}</p>
                        </div>
                    </div>
                    <hr class="mt-2 border border-gray-200">

                    <div>
                        <div class="flex justify-between mt-2">
                            <p>Base Fare</p>
                            <p>Rs. 100.00</p>
                        </div>
                        <div class="flex justify-between mt-2">
                            <p>Distance Fare</p>
                            <p>Rs. 100.00</p>
                        </div>

                        <div class="flex justify-between mt-2 font-bold">
                            <p>Total</p>
                            <p>Rs. 100.00</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4 bottom-0">
                        <button
                            class="border border-black w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-black text-sm font-bold py-2 px-4 rounded">
                            Cancel Ride
                        </button>
                        <button
                            class="bg-black w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-white text-sm font-bold py-2 px-4 rounded">
                            Start Ride
                        </button>
                    </div>

                </div>
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
