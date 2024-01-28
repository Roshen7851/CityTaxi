<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {ref} from "vue";

const form = useForm({
    name: '',
    email: '',
    contact: '',
    address: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const step = ref(1);
</script>

<template>
    <Head title="Register"/>

    <div class="flex items-center justify-center">
        <div class="w-full sm:w-1/2 px-3">
            <div class="text-center sm:text-left max-w-lg mx-auto mb-8 px-12">
                <a href="/" class="text-yellow-500 text-2xl mb-4 font-bold font-heading ">
                    City Taxi
                </a>
                <p class="text-blue-500 font-bold font-heading  mb-6">
                    Register with city taxi
                </p>


                <ol class="mb-4 items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
                    <li :class="{ 'text-blue-600 dark:text-blue-500': step === 1, 'text-gray-500 dark:text-gray-400': step !== 1 }"
                        class="flex items-center space-x-2.5 rtl:space-x-reverse">
    <span class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0"
          :class="{ 'border-blue-600 dark:border-blue-500': step === 1, 'border-gray-500 dark:border-gray-400': step !== 1 }">
        1
    </span>
                        <span>
        <h3 class="font-medium leading-tight">User info</h3>
        <p class="text-sm">Step details here</p>
    </span>
                    </li>

                    <li :class="{ 'text-blue-600 dark:text-blue-500': step === 2, 'text-gray-500 dark:text-gray-400': step !== 2 }"
                        class="flex items-center space-x-2.5 rtl:space-x-reverse">
    <span class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0"
          :class="{ 'border-blue-600 dark:border-blue-500': step === 2, 'border-gray-500 dark:border-gray-400': step !== 2 }">
        2
    </span>
                        <span>
        <h3 class="font-medium leading-tight">Vehicle info</h3>
        <p class="text-sm">Step details here</p>
    </span>
                    </li>

                </ol>


                <form @submit.prevent="submit">
                    <div v-if="step===1">
                        <div>
                            <InputLabel for="name" value="Name"/>
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="contact" value="Contact Number"/>
                            <TextInput
                                id="contact"
                                v-model="form.contact"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.contact"/>
                        </div>
                        <div class="mt-4">
                            <InputLabel for="address" value="Address"/>
                            <TextInput
                                id="address"
                                v-model="form.address"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.address"/>
                        </div>


                        <div class="mt-4">
                            <InputLabel for="email" value="Email"/>
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                required
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Password"/>
                            <TextInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password_confirmation" value="Confirm Password"/>
                            <TextInput
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload Driver License Front</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload Driver License Back</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            </div>
                        </div>

                        <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                            <InputLabel for="terms">
                                <div class="flex items-center">
                                    <Checkbox id="terms" v-model:checked="form.terms" name="terms" required/>

                                    <div class="ms-2">
                                        I agree to the <a target="_blank" :href="route('terms.show')"
                                                          class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms
                                        of Service</a> and <a target="_blank" :href="route('policy.show')"
                                                              class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy
                                        Policy</a>
                                    </div>
                                </div>
                                <InputError class="mt-2" :message="form.errors.terms"/>
                            </InputLabel>
                        </div>
                        <div class="flex items-center justify-end mt-4">


                            <a @click="step=2"
                               class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4">
                                Next
                            </a>

                        </div>
                    </div>

                    <div v-else-if="step === 2">
                        <div class="mt-4">
                            <InputLabel for="model" value="Brand"/>
                            <TextInput
                                id="model"
                                v-model="form.model"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="ex Suzuki"
                            />
                            <InputError class="mt-2" :message="form.errors.model"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="model" value="Model"/>
                            <TextInput
                                id="model"
                                v-model="form.model"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="ex Alto"
                            />
                            <InputError class="mt-2" :message="form.errors.model"/>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div>
                                <InputLabel for="model" value="Manufactured Year"/>
                                <TextInput
                                    id="model"
                                    v-model="form.model"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    placeholder="ex 2015"
                                />
                                <InputError class="mt-2" :message="form.errors.model"/>
                            </div>
                            <div>
                                <InputLabel for="model" value="Registered Year"/>
                                <TextInput
                                    id="model"
                                    v-model="form.model"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    placeholder="ex 2017"
                                />
                                <InputError class="mt-2" :message="form.errors.model"/>
                            </div>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="model" value="Registration Number"/>
                            <TextInput
                                id="model"
                                v-model="form.model"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="ex ABC-1234"
                            />
                            <InputError class="mt-2" :message="form.errors.model"/>
                        </div>
                        <div class="mt-4">
                            <InputLabel for="model" value="Color"/>
                            <TextInput
                                id="model"
                                v-model="form.model"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="ex Red"
                            />
                            <InputError class="mt-2" :message="form.errors.model"/>
                        </div>

                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="file_input">Upload Vehicle License</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input" type="file">
                        </div>

                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="file_input">Upload Vehicle Insurance</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input" type="file">
                        </div>

                        <div class="grid grid-cols-4  mt-4">
                            <a @click="step=1"
                               class="ml-0 inline-flex col-span-1 items-center px-2 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4">
                                Previous
                            </a>

                            <div class="col-span-3 text-right">

                                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                               :disabled="form.processing">
                                    Register
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-right">
                        <Link :href="route('login')"
                              class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Already registered?
                        </Link>
                    </div>


                </form>


            </div>
        </div>

        <div class="hidden sm:block w-full sm:w-1/2 px-3 bg-gradient-to-b from-yellow-500 to-yellow-50">
            <div class="mx-auto max-w-lg flex flex-col items-center justify-center h-screen px-6 text-center text-lg">
                <a class="text-3xl font-semibold leading-none" href="/">
                    <img class="h-32" src="../../../assets/images/logo.svg" alt="">
                </a>
                <p class="font-medium mt-6">At City Taxi Booking Company, we envision a future where transportation is
                    seamless,
                    efficient, and tailored to the individual needs of our customers. We strive to be the
                    preferred choice for reliable and innovative transportation solutions, setting the standard
                    for excellence in the industry.</p>
            </div>
        </div>
    </div>
</template>
