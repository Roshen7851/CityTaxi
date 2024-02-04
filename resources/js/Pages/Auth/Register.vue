<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register-passenger'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="flex items-center justify-center">
        <div class="w-full sm:w-1/2 px-3">
            <div class="text-center sm:text-left max-w-lg mx-auto mb-8 px-12">
                <a href="/" class="text-yellow-500 text-2xl mb-4 font-bold font-heading ">
                    City Taxi
                </a>
                <p class="text-blue-500 font-bold font-heading  mb-6">
                   Register with city taxi
                </p>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="contact" value="Contact Number" />
                        <TextInput
                            id="contact"
                            v-model="form.phone"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
<!--                    <div class="mt-4">-->
<!--                        <InputLabel for="address" value="Address" />-->
<!--                        <TextInput-->
<!--                            id="address"-->
<!--                            v-model="form.address"-->
<!--                            type="text"-->
<!--                            class="mt-1 block w-full"-->
<!--                            required-->
<!--                            autofocus-->
<!--                            autocomplete="name"-->
<!--                        />-->
<!--                        <InputError class="mt-2" :message="form.errors.address" />-->
<!--                    </div>-->


                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
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
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                        <InputLabel for="terms">
                            <div class="flex items-center">
                                <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                                <div class="ms-2">
                                    I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy Policy</a>
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.terms" />
                        </InputLabel>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link :href="route('login')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Already registered?
                        </Link>

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Register
                        </PrimaryButton>
                    </div>
                </form>




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
