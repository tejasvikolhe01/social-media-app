<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    firstname: '',
    lastname: '',
    dob:'',
    username:'',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <div class="container">
            <form @submit.prevent="submit" class="col-lg-5 offset-lg-3" aria-label="Register User">
                <div class="row g-3">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <InputLabel for="firstname" value="Firstname" />
                        <TextInput
                            id="firstname"
                            type="text"
                            v-model="form.firstname"
                            autofocus
                            aria-label="firstnameLabel"
                        />
                        <InputError :message="form.errors.firstname" />
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <InputLabel for="lastname" value="Lastname" />
                        <TextInput
                            id="lastname"
                            type="text"
                            v-model="form.lastname"
                            autofocus
                            aria-label="lastnameLabel"
                        />
                        <InputError :message="form.errors.lastname" />
                    </div>                        
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <InputLabel for="dob" value="dob" />
                        <TextInput
                            id="dob"
                            type="date"
                            v-model="form.dob"
                            aria-label="dobLabel"
                        />
                        <InputError :message="form.errors.dob" />
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <InputLabel for="username" value="username" />
                        <TextInput
                            id="username"
                            type="text"
                            v-model="form.username"
                            aria-label="usernameLabel"
                        />
                        <InputError :message="form.errors.username" />
                    </div>     
                    <div class="col-12">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            v-model="form.email"
                            aria-label="emailLabel"
                        />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="col-12">
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            v-model="form.password"
                            aria-label="newPasswordLabel"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                    <div class="col-12">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            v-model="form.password_confirmation"
                            aria-label="confirmPasswordLabel"
                        />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>
                    <div class="col-12">
                        <PrimaryButton>
                            Register
                        </PrimaryButton>
                    </div>
                    <div class="col-12">
                        <Link
                            :href="route('login')"
                            aria-label="Already registered?">
                            Already registered?
                        </Link>
                    </div>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>