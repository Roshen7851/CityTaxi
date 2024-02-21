<script>
import RatingComponent from "@/Components/RatingComponent.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

const page = usePage()
export default {
    components: {
        RatingComponent,
        AppLayout
    },
    props: {
        rides: {}
    },
    setup(props) {
        const user = computed(() => page.props.auth.user)
        const role = computed(() => page.props.auth.role)

        return {
            user,
            role
        }
    }
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                My Trips
            </h2>
        </template>

        <div class="py-12 p-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption
                        class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Trips
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of trips
                            history.</p>
                    </caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Date and time
                        </th>

                        <th v-if="role=='call_center'|| role == 'admin'" scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th v-if="role=='call_center'|| role == 'admin'" scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th v-if="role=='call_center' || role == 'admin'" scope="col" class="px-6 py-3">
                            Phone
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Vehicle
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pickup Location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Destination
                        </th>
                        <th scope="col" class="px-6 py-3">
                            status
                        </th>
                        <th scope="col" class="px-6 py-3" v-if=" role == 'admin'">
                            type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="ride in rides" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ride.created_at }}
                        </th>
                        <td v-if="(role=='call_center' || role == 'admin')" class="px-6 py-4">
                            {{ ride.guest?.name }}
                        </td>
                        <td v-if="role=='call_center' || role == 'admin'" class="px-6 py-4">
                            {{ ride.guest?.email }}
                        </td>
                        <td v-if="role=='call_center' || role == 'admin'" class="px-6 py-4">
                            {{ ride.guest?.phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ ride.vehicle.model.title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ ride.start_location }}
                        </td>
                        <td class="px-6 py-4">
                            {{ ride.end_location }}
                        </td>
                        <td class="px-6 py-4">
                            <button
                                class="border-green-500 border text-black w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3  text-sm font-bold py-2 px-4 rounded">
                                {{ ride.status }}
                            </button>
                        </td>
                        <td class="px-6 py-4" v-if=" role == 'admin'">
                            <button v-if="ride.user_type == 'guest_user'"
                                    class="bg-black w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-white text-sm font-bold py-2 px-4 rounded">
                                Guest
                            </button>
                            <button v-else
                                    class="bg-purple-600 w-full dark:bg-yellow-500 hover:bg-yellow-500 mt-3 text-white text-sm font-bold py-2 px-4 rounded">
                                User
                            </button>
                        </td>
                        <td class="px-6 py-4 ">
                            Rs {{ parseFloat(ride.total).toFixed(2) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
