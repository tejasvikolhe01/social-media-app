<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div v-if="status" class="text-success">
            {{ status }}
        </div>
        <form @submit.prevent="submit" class="col-lg-4 offset-lg-4 px-4" aria-label="User Login">
            <div class="row g-3">
                <div class="col-12">
                    
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="form-control"
                        v-model="form.email"
                        autofocus
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
                        autocomplete="current-password"
                        aria-label="passwordLabel"
                    />
                    <InputError :message="form.errors.password" />
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-end"
                        aria-label="Forgot your password link"
                    >
                        Forgot your password?
                    </Link>
                </div>
                <div class="form-check">
                    <Checkbox name="remember" v-model:checked="form.remember" aria-label="rememberMeLabel"/>
                    <label class="form-check-label" for="flexCheckDefault">
                        Remember me
                    </label>
                </div>
                <div class="col-12">
                    <PrimaryButton>
                        Log in
                    </PrimaryButton>
                </div>
                <Link
                    :href="route('register')"
                    aria-label="Don't have account? Click here to register">
                    Don't have account? Click here to register
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
