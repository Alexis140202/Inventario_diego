<script setup lang="ts">
import { ref } from 'vue';
import Headerwelcome from '@/components/header_principal/headerwelcome.vue';

const currentIndex = ref(0);

// Define an array of images
const imageList = [
    '/storage/logo_welcome/almacen.png',
    '/storage/logo_welcome/almacen.png',
    '/storage/logo_welcome/almacen.png'
];

function goToSlide(index: number) {
    currentIndex.value = index;
}

function prevSlide() {
    currentIndex.value = (currentIndex.value - 1 + imageList.length) % imageList.length;
}

function nextSlide() {
    currentIndex.value = (currentIndex.value + 1) % imageList.length;
}
</script>

<template>
    <Headerwelcome />

    <div class="relative flex w-full">
        <!-- Menu lateral -->
        <div
            class="w-56 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 p-4 flex flex-col space-y-4 shadow-md">
            <!-- Encabezado del menú -->
            <div class="text-center border-b border-gray-200 dark:border-gray-700 pb-3 mb-2">
                <h3 class="text-lg font-semibold text-blue-600">Galería de imágenes</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Selecciona una opción</p>
            </div>

            <!-- Botones del menú (solo título) -->
            <button class="px-4 py-2 rounded-lg text-left transition-colors" :class="currentIndex === 0
                ? 'bg-blue-600 text-white font-bold shadow-sm'
                : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700'"
                @click="currentIndex = 0">
                <p class="font-semibold">Imagen 1</p>
            </button>

            <button class="px-4 py-2 rounded-lg text-left transition-colors" :class="currentIndex === 1
                ? 'bg-blue-600 text-white font-bold shadow-sm'
                : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700'"
                @click="currentIndex = 1">
                <p class="font-semibold">Imagen 2</p>
            </button>

            <button class="px-4 py-2 rounded-lg text-left transition-colors" :class="currentIndex === 2
                ? 'bg-blue-600 text-white font-bold shadow-sm'
                : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700'"
                @click="currentIndex = 2">
                <p class="font-semibold">Imagen 3</p>
            </button>
        </div>

        <!-- Carousel con texto lateral -->
        <div class="relative w-full flex">
            <!-- Imagen con borde -->
            <div
                class="relative h-56 md:h-96 w-2/3 border border-gray-300 rounded-lg overflow-hidden flex items-center justify-center bg-white">
                <img v-show="currentIndex === 0" src="/storage/logo_welcome/almacen.png"
                    class="max-h-full max-w-full object-contain" alt="Imagen 1" />
                <img v-show="currentIndex === 1" src="/storage/logo_welcome/almacen.png"
                    class="max-h-full max-w-full object-contain" alt="Imagen 2" />
                <img v-show="currentIndex === 2" src="/storage/logo_welcome/almacen.png"
                    class="max-h-full max-w-full object-contain" alt="Imagen 3" />

                <!-- Controles -->
                <button class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white rounded-full p-2"
                    @click="prevSlide">
                    <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                </button>

                <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white rounded-full p-2"
                    @click="nextSlide">
                    <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                </button>
            </div>

            <!-- Texto lateral dinámico con ajuste -->
            <div class="w-1/3 p-6 flex flex-col overflow-y-auto break-words">
                <div v-show="currentIndex === 0" class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-800">Imagen 1</h2>
                    <p class="mt-2 text-gray-600 text-justify">
                        Velit taciti aliquet augue vitae nisl suscipit dis hendrerit aptent penatibus, tempor maecenas
                        bibendum iaculis et senectus facilisis felis. Bibendum sem suscipit vitae montes interdum nisi
                        semper cum, malesuada gravida lectus metus facilisi lobortis habitasse orci vehicula, id netus
                        sociis massa viverra hac donec. Rhoncus sociosqu proin sed ultricies venenatis convallis
                        pharetra natoque, sapien nisi platea a mauris ridiculus dapibus primis phasellus, fringilla
                        risus justo lacinia quis fermentum vitae.
                    </p>
                </div>
                <div v-show="currentIndex === 1" class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-800">Imagen 2</h2>
                    <p class="mt-2 text-gray-600 text-justify">
                        Texto 2.
                    </p>
                </div>
                <div v-show="currentIndex === 2" class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-800">Imagen 3</h2>
                    <p class="mt-2 text-gray-600 text-justify">
                        Texto 3.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
