<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

import { ref } from 'vue'
import Headerwelcome from '@/components/header_principal/headerwelcome.vue';


const mobileMenuOpen = ref(false)
</script>


<template>


    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>


    <Headerwelcome />
    <div class="background: linear-gradient(135deg, #E3FCF6, #E8FAFA, #E6FDF7)">


        <div class="relative isolate px-6 pt-14 lg:px-8">

            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class=" flex items-center justify-center">
                        <img src="/storage/logo_welcome/almacen.png" alt="Logo Almacen" class="h-50 w-50" />
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-5xl font-semibold tracking-tight text-black sm:text-7xl"> INVENTARIO </h1>
                    <p class="mt-8 text-lg font-medium text-gray-700 sm:text-xl leading-relaxed">
                        Gestiona de manera sencilla tu
                        inventario, organiza a tus trabajadores, administra tus tiendas y lleva un control completo de
                        tus ventas,
                        todo desde un solo lugar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>