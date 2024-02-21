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
        data: {}
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
                Vehicle List
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
                            Registration Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Manufactured Year
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Registered Year
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="item in data.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{item.registration_number}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{item.brand?.title}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{item.model?.title}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{item.model?.vehicle_type?.name}}
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{item.manufactured_year}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{item.registered_year}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{item.color}}
                        </th>


                    </tr>
                    </tbody>
                </table>

                <div class="mt-5" v-if="data.links.length > 3">
                    <div class="flex flex-wrap -mb-1">
                        <template v-for="(link, key) in data.links">
                            <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                            <a v-else  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
