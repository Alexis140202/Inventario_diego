<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

import { ref } from 'vue'
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import Headerwelcome from '@/components/header_principal/headerwelcome.vue';


const mobileMenuOpen = ref(false)
</script>


<template>

<Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

  <Headerwelcome />

  <div class="background: linear-gradient(135deg, #E3FCF6, #E8FAFA, #E6FDF7">
    <header class="absolute inset-x-0 top-0 z-50">
      <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex items-center space-x-2">
          <div class="w-6 h-6 rounded-full bg-[#00A3FF] flex items-center justify-center text-white font-bold">
            i
          </div>
          <span class="text-lg font-semibold text-black">inventario</span>
        </div>

        <div class="flex lg:hidden">
          <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-200"
            @click="mobileMenuOpen = true">
            <span class="sr-only">Open main menu</span>
            <Bars3Icon class="size-6" aria-hidden="true" />
          </button>
        </div>
        
      </nav>
      <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
        <div class="fixed inset-0 z-50" />
        <DialogPanel
          class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-100/10">
          <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <img class="h-8 w-auto"
                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="" />
            </a>
            <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-200" @click="mobileMenuOpen = false">
              <span class="sr-only">Close menu</span>
              <XMarkIcon class="size-6" aria-hidden="true" />
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-white/10">

              <div class="py-6">
                <a href="#"
                  class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-white/5">Log
                  in</a>
              </div>
            </div>
          </div>
        </DialogPanel>
      </Dialog>
    </header>

    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
        aria-hidden="true">
        <div
          class="relative left-[calc(50%-11rem)] aspect-1155/678 w-144.5 -translate-x-1/2 rotate-30 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-288.75"
          style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
      </div>
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
            inventario, organiza a tus trabajadores, administra tus tiendas y lleva un control completo de tus ventas,
            todo desde un solo lugar.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>