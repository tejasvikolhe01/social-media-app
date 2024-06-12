<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />
        <div class="col-lg-4 offset-lg-4 px-4">
            <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.</p>

            <div v-if="status" class="text-success">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div class="row g-3">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        autofocus
                    />
                    <InputError :message="form.errors.email" />
                    <div class="col-12">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Email Password Reset Link
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
