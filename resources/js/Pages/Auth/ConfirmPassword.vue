<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />
        <p>
            This is a secure area of the application. Please confirm your password before continuing.
        </p>
        <form @submit.prevent="submit">
            <InputLabel for="password" value="Password" />
            <TextInput
                id="password"
                type="password"
                v-model="form.password"
                autocomplete="current-password"
                autofocus
            />
            <InputError :message="form.errors.password" />
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Confirm
            </PrimaryButton>
        </form>
    </GuestLayout>
</template>
