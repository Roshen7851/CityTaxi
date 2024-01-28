<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in"/>
    <div class="flex items-center justify-center">
        <div class="w-full sm:w-1/2 px-3">
            <div class="text-center sm:text-left max-w-lg mx-auto mb-8 px-12">
                <a href="/" class="text-yellow-500 text-2xl mb-4 font-bold font-heading ">
                    City Taxi
                </a>
                <p class="text-blue-500 font-bold font-heading  mb-6">
                   Log in to your account
                </p>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox v-model:checked="form.remember" name="remember" />
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Forgot your password?
                        </Link>

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>
                </form>

<!--                google auth-->
                <button class="border-2 border-blue-500 w-full mt-5 text-black hover:bg-yellow-500 dark:text-white text-sm font-bold py-2 px-4 rounded">
                    <a href="{{ route('login.google') }}">Login with Google</a>
                </button>

                <div class="grid grid-cols-2 gap-4">
                    <a href="/register" class=" text-center bg-blue-950 dark:bg-gray-700 text-white w-full mt-5  hover:bg-white border-2 hover:border-2 border-blue-950 hover:text-black dark:text-white text-sm font-bold py-2 px-4 rounded">
                        Sign up as passenger
                    </a>
                    <a  href="/register-driver" class="text-center w-full mt-5 dark:border-gray-700 hover:bg-blue-950 border-2 border-blue-950 hover:text-white dark:text-white text-sm font-bold py-2 px-4 rounded">
                        Sign up as driver
                    </a>
                </div>


            </div>
        </div>

        <div class="hidden sm:block w-full sm:w-1/2 px-3 bg-gradient-to-b from-yellow-500 to-yellow-50">
            <div class="mx-auto max-w-lg flex flex-col items-center justify-center h-screen px-6 text-center text-lg">
                <a class="text-3xl font-semibold leading-none" href="/">
                    <img class="h-32" src="../../../assets/images/logo.svg" alt="">
                </a>
                <p class="font-medium mt-6">At City Taxi Booking Company, we envision a future where transportation is seamless,
                    efficient, and tailored to the individual needs of our customers. We strive to be the
                    preferred choice for reliable and innovative transportation solutions, setting the standard
                    for excellence in the industry.</p>
            </div>
        </div>
    </div>
</template>
