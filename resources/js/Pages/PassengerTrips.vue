<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import {GoogleAutocomplete} from 'vue3-google-autocomplete'
import {ref} from "vue";

const value = ref()
const value2 = ref()
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                My Trips
            </h2>
        </template>

        <div class="py-12 p-6">

        </div>
    </AppLayout>
</template>
