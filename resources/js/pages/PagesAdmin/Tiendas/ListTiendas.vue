<template>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="flex items-center text-2xl font-bold text-gray-800">
                <StoreIcon class="mr-2 h-6 w-6" />
                Lista de Tiendas
            </h2>
        </div>

        <!-- Vista de tabla para PC -->
        <div class="hidden overflow-x-auto rounded-lg border border-gray-200 shadow-sm md:block">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                            <div class="flex items-center">
                                <HashIcon class="mr-1 h-4 w-4" />
                                ID
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                            <div class="flex items-center">
                                <TagIcon class="mr-1 h-4 w-4" />
                                Nombre
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                            <div class="flex items-center">
                                <AlignLeftIcon class="mr-1 h-4 w-4" />
                                Descripción
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                            <div class="flex items-center">
                                <ImageIcon class="mr-1 h-4 w-4" />
                                Foto
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                            <div class="flex items-center">
                                <CalendarPlusIcon class="mr-1 h-4 w-4" />
                                Creación
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                            <div class="flex items-center">
                                <CalendarCheckIcon class="mr-1 h-4 w-4" />
                                Actualización
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium tracking-wider text-gray-500 uppercase">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="tienda in tiendas" :key="tienda.id" class="transition-colors hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900">
                            {{ tienda.id }}
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold whitespace-nowrap text-gray-800">
                            {{ tienda.nombre }}
                        </td>
                        <td class="max-w-xs truncate px-6 py-4 text-sm text-gray-500">
                            {{ tienda.descripcion }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img :src="tienda.foto" alt="Foto"
                                class="h-12 w-12 cursor-pointer rounded-lg border border-gray-200 object-cover"
                                @click="openImageModal(tienda.foto)" />
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500">
                            {{ tienda.creacion }}
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500">
                            {{ tienda.actualizacion }}
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium whitespace-nowrap">
                            <div class="flex justify-end space-x-2">
                                <button class="rounded-full p-1 text-blue-600 hover:bg-blue-50 hover:text-blue-900">
                                    <EditIcon class="h-5 w-5" />
                                </button>
                                <button class="rounded-full p-1 text-red-600 hover:bg-red-50 hover:text-red-900"
                                    @click="eliminarTienda(tienda.id)">
                                    <Trash2Icon class="h-5 w-5" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Vista de tarjetas para móvil -->
        <div class="grid grid-cols-1 gap-4 md:hidden">
            <div v-for="tienda in tiendas" :key="tienda.id"
                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                <div class="flex items-start space-x-4">
                    <img :src="tienda.foto" alt="Foto"
                        class="h-16 w-16 cursor-pointer rounded-lg border border-gray-200 object-cover"
                        @click="openImageModal(tienda.foto)" />
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">{{ tienda.nombre }}</h3>
                            <span
                                class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                ID: {{ tienda.id }}
                            </span>
                        </div>
                        <p class="mt-1 text-sm text-gray-600">{{ tienda.descripcion }}</p>

                        <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                            <div class="flex items-center text-gray-500">
                                <CalendarPlusIcon class="mr-1 h-4 w-4" />
                                <span>{{ tienda.creacion }}</span>
                            </div>
                            <div class="flex items-center text-gray-500">
                                <CalendarCheckIcon class="mr-1 h-4 w-4" />
                                <span>{{ tienda.actualizacion }}</span>
                            </div>
                        </div>

                        <div class="mt-3 flex space-x-2">
                            <button class="rounded-full p-1 text-blue-600 hover:bg-blue-50 hover:text-blue-900">
                                <EditIcon class="h-5 w-5" />
                            </button>
                            <button class="rounded-full p-1 text-red-600 hover:bg-red-50 hover:text-red-900">
                                <Trash2Icon class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para imagen grande -->
        <div v-if="showImageModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm"
            @click.self="closeImageModal">
            <div class="relative flex w-full max-w-3xl flex-col items-center rounded-xl bg-white p-6 shadow-2xl">
                <button @click="closeImageModal"
                    class="absolute top-4 right-4 z-10 flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-2xl text-gray-700 shadow-lg transition hover:bg-gray-100 hover:text-red-500"
                    aria-label="Cerrar">
                    <XIcon class="h-6 w-6" />
                </button>
                <img :src="modalImageUrl" alt="Imagen grande"
                    class="h-auto max-h-[80vh] w-full rounded-xl object-contain transition-transform duration-300" />
            </div>
        </div>

        <!-- Modal de confirmación de eliminación -->
        <div v-if="showDeleteModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                <h3 class="text-lg font-semibold mb-4">¿Seguro que deseas eliminar esta tienda?</h3>
                <div class="flex justify-center space-x-4">
                    <button @click="confirmarEliminar"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Eliminar</button>
                    <button @click="cancelarEliminar"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancelar</button>
                </div>
            </div>
        </div>

        <!-- Modal de éxito -->
        <div v-if="showSuccessModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                <h3 class="text-lg font-semibold mb-4 text-green-700">¡Tienda eliminada exitosamente!</h3>
                <button @click="cerrarSuccessModal"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Cerrar</button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
const showImageModal = ref(false);
const modalImageUrl = ref('');
const showDeleteModal = ref(false);
const tiendaAEliminar = ref<number | null>(null);
const showSuccessModal = ref(false);
import {
    AlignLeftIcon,
    CalendarCheckIcon,
    CalendarPlusIcon,
    EditIcon,
    HashIcon,
    ImageIcon,
    StoreIcon,
    TagIcon,
    Trash2Icon,
    XIcon,
} from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';

interface Tienda {
    id: number;
    nombre: string;
    descripcion: string;
    imagen?: string;
    foto?: string;
    created_at?: string;
    updated_at?: string;
}

const tiendas = ref<Array<{
    id: number;
    nombre: string;
    descripcion: string;
    foto: string;
    creacion: string;
    actualizacion: string;
}>>([]);
onMounted(async () => {
    await cargarTiendas();
});

async function cargarTiendas() {
    try {
        const response = await axios.get('/tiendas');
        tiendas.value = response.data.map((tienda: Tienda) => ({
            id: tienda.id,
            nombre: tienda.nombre,
            descripcion: tienda.descripcion,
            foto: tienda.imagen ? `/storage/${tienda.imagen}` : '',
            creacion: tienda.created_at ? new Date(tienda.created_at).toLocaleDateString() : '',
            actualizacion: tienda.updated_at ? new Date(tienda.updated_at).toLocaleDateString() : '',
        }));
    } catch (error) {
        console.error('Error al obtener tiendas:', error);
    }
}

function openImageModal(url: string) {
    modalImageUrl.value = url;
    showImageModal.value = true;
}

function closeImageModal() {
    showImageModal.value = false;
    modalImageUrl.value = '';
}

async function eliminarTienda(id: number) {
    tiendaAEliminar.value = id;
    showDeleteModal.value = true;
}

async function confirmarEliminar() {
    if (tiendaAEliminar.value === null) return;
    try {
        await axios.delete(`/tiendas/${tiendaAEliminar.value}`);
        await cargarTiendas();
        showSuccessModal.value = true; // Muestra el modal de éxito
    } catch (error) {
        alert('Error al eliminar tienda');
    } finally {
        showDeleteModal.value = false;
        tiendaAEliminar.value = null;
    }
}

function cerrarSuccessModal() {
    showSuccessModal.value = false;
}

function cancelarEliminar() {
    showDeleteModal.value = false;
    tiendaAEliminar.value = null;
}
</script>
