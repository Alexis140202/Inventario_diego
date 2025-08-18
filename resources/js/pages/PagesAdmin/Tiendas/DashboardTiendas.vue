<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import FormCreateTiendas from './FormCreateTiendas.vue';
import ListTiendas from './ListTiendas.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'GESTION DE TIENDAS',
        href: '/Tiendas',
    },
];

const showModal = ref(false);

function openModal() {
    showModal.value = true;
}
function closeModal() {
    showModal.value = false;
}
</script>

<template>
    <Head title="Formulario Tiendas" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <!-- Botón agregar -->
                <div class="mt-6 mr-8 mb-4 flex justify-end">
                    <button @click="openModal" class="flex items-center gap-2 rounded bg-blue-600 px-4 py-2 text-white shadow hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Agregar Tienda
                    </button>
                </div>

                <!-- Lista Tiendas -->
                <ListTiendas />
            </div>
        </div>
    </AppLayout>

    <!-- Modal -->
    <FormCreateTiendas :open="showModal" @close="closeModal" />
</template>
