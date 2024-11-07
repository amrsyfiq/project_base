<script setup>
import { ref, reactive, watchEffect } from 'vue';
import Footer from '@/Layouts/Footer.vue';
import Navbar from '@/Layouts/Navbar.vue';
import Sidebar from '@/Layouts/Sidebar.vue';

const dropdown = reactive({
    admin: false,
    menu: false
})

const getData = (value) => {
    dropdown.menu = value;
}

</script>

<template>
    <div class="flex h-screen overflow-hidden bg-gray-100 dark:bg-gray-900">
        <!-- Navbar -->
        <Navbar @menu-bar="getData"/>

        <!-- Sidebar -->
        <Sidebar :menuBar="dropdown.menu"/>

        <!-- Page Content -->
        <div class="pt-16 px-8 relative w-full h-full flex flex-col min-h-screen overflow-y-auto bg-gray-50 sm:ml-64 dark:bg-gray-900">
            <main>
                <slot />
            </main>

            <!-- Footer -->
            <Footer/>
        </div>
    </div>
</template>
