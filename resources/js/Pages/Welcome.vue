<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
      <header class="bg-body-tertiary pb-3 pt-3">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <span>Logo</span>
            </div>
            <ul class="col-md-8 nav justify-content-end">
              <li class="nav-item" v-if="canLogin">
                <a v-if="$page.props.auth.user" class="nav-link active" :href="route('dashboard')">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" :href="route('login')">login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" :href="route('register')">Register</a>
              </li>
            </ul>
          </div>
        </div>
      </header>
      <!-- main content -->
      <main class="container pb-3 pt-3">
        <h1 class="text-center">Welcome to Blue Bay Travel</h1>
      </main><!-- main content -->
      <!-- Footer -->
      <footer class="bg-body-tertiary pb-3 pt-3">
        <!-- Copyright -->
        <div class="text-center">
          © 2024 Copyright:
          <a class="text-reset fw-bold" href="#">BlueBayTravel</a>
        </div><!-- Copyright -->
      </footer><!-- Footer --> 
</template>
