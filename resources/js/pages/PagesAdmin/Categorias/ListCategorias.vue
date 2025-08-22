<template>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="flex items-center text-2xl font-bold text-gray-800">
                <StoreIcon class="mr-2 h-6 w-6" />
                Lista de Categorias
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
                                <TagIcon class="mr-1 h-4 w-4" />
                                Nombre
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
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                            <div class="flex items-center">
                                <CalendarCheckIcon class="mr-1 h-4 w-4" />
                                Marcas
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium tracking-wider text-gray-500 uppercase">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="tienda in tiendas" :key="tienda.id" class="transition-colors hover:bg-gray-50">

                        <td class="px-6 py-4 text-sm font-semibold whitespace-nowrap text-gray-800">
                            {{ tienda.nombre }}
                        </td>

                        <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500">
                            {{ tienda.creacion }}
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500">
                            {{ tienda.actualizacion }}
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 flex items-center space-x-2">
                            {{ tienda.marcas.length }}
                            <button class="rounded-full p-1 text-indigo-600 hover:bg-indigo-50 hover:text-indigo-900"
                                title="Ver marcas" @click="abrirModalEditarMarcas(tienda)">
                                <EyeIcon class="h-5 w-5" />
                            </button>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium whitespace-nowrap">
                            <div class="flex justify-end space-x-2">
                                <button class="rounded-full p-1 text-blue-600 hover:bg-blue-50 hover:text-blue-900"
                                    @click="abrirModalEdicion(tienda)">
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
                class="rounded-xl border border-gray-200 bg-white p-4 shadow transition hover:shadow-md">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ tienda.nombre }}</h3>

                    <!-- Chips de marcas -->
                    <div class="flex flex-wrap gap-2 mb-3">
                        <span v-if="tienda.marcas.length === 0" class="text-gray-400 text-xs">Sin marcas</span>
                        <span v-for="marca in tienda.marcas.slice(0, 3)" :key="marca.id"
                            class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                            <TagIcon class="mr-1 h-3 w-3 text-green-500" /> {{ marca.nombre }}
                        </span>
                        <button class="rounded-full p-1 text-indigo-600 hover:bg-indigo-50 hover:text-indigo-900"
                            title="Editar marcas" @click="abrirModalEditarMarcas(tienda)">
                            <EyeIcon class="h-5 w-5" />
                        </button>
                        <span v-if="tienda.marcas.length > 3"
                            class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">
                            +{{ tienda.marcas.length - 3 }} más
                        </span>
                    </div>

                    <div class="grid grid-cols-1 gap-2 text-sm mb-3">
                        <div class="flex items-center text-gray-500">
                            <CalendarPlusIcon class="mr-1 h-4 w-4" />
                            <span class="font-semibold mr-1">Creación:</span>
                            <span>{{ tienda.creacion }}</span>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <CalendarCheckIcon class="mr-1 h-4 w-4" />
                            <span class="font-semibold mr-1">Actualización:</span>
                            <span>{{ tienda.actualizacion }}</span>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-2">
                        <button class="rounded-full p-2 text-blue-600 hover:bg-blue-50 hover:text-blue-900"
                            @click="abrirModalEdicion(tienda)">
                            <EditIcon class="h-5 w-5" />
                        </button>
                        <button class="rounded-full p-2 text-red-600 hover:bg-red-50 hover:text-red-900"
                            @click="eliminarTienda(tienda.id)">
                            <Trash2Icon class="h-5 w-5" />
                        </button>
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
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 backdrop-blur-sm">
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

    <UpdateCategorias :open="showEditModal" :tienda="tiendaSeleccionada" @close="cerrarModalEdicion" />
    <ListMarcas :open="showMarcasModal" :categoria-id="tiendaSeleccionada?.id" :marcas="marcasSeleccionadas"
        @close="showMarcasModal = false" />


</template>

<script setup lang="ts">
const showImageModal = ref(false);
const modalImageUrl = ref('');
const showDeleteModal = ref(false);
const tiendaAEliminar = ref<number | null>(null);
const showSuccessModal = ref(false);
const showEditModal = ref(false);
const tiendaSeleccionada = ref<any>(null);
const marcasSeleccionadas = ref<any[]>([]);
const showMarcasModal = ref(false);
import {
    EyeIcon,
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
import UpdateCategorias from './UpdateCategorias.vue';
import ListMarcas from '../Marcas/ListMarcas.vue';

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
    marcas: any[];
}>>([]);
onMounted(async () => {
    await cargarTiendas();
});

async function cargarTiendas() {
    try {
        const response = await axios.get('/categorias');
        tiendas.value = response.data.map((categoria: any) => ({
            id: categoria.id,
            nombre: categoria.nombre,
            marcas: categoria.marcas || [],
            creacion: categoria.created_at
                ? new Date(categoria.created_at).toLocaleString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' })
                : '',
            actualizacion: categoria.updated_at
                ? new Date(categoria.updated_at).toLocaleString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' })
                : '',
        }));
        console.log('Categorias cargadas:', tiendas.value);
    } catch (error) {
        console.error('Error al obtener categorias:', error);
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
        await axios.delete(`/categorias/${tiendaAEliminar.value}`);
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

function abrirModalEdicion(tienda: any) {
    tiendaSeleccionada.value = tienda;
    showEditModal.value = true;
}

function cerrarModalEdicion() {
    showEditModal.value = false;
    tiendaSeleccionada.value = null;
}
function abrirModalEditarMarcas(tienda: any) {
    marcasSeleccionadas.value = tienda.marcas || [];
    showMarcasModal.value = true;
    // Aquí puedes abrir el modal o pasar las marcas al componente
}
</script>
