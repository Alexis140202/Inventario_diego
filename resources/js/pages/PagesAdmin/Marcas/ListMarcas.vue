<template>
    <div v-if="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="relative bg-white rounded-xl shadow-2xl p-6 w-full max-w-lg">
            <button @click="$emit('close')"
                class="absolute top-4 right-4 flex h-8 w-8 items-center justify-center rounded-full border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 hover:text-red-500"
                aria-label="Cerrar">
                <XIcon class="h-5 w-5" />
            </button>
            <div class="container mx-auto px-4 py-4">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="flex items-center text-xl font-bold text-gray-800">
                        <StoreIcon class="mr-2 h-6 w-6" />
                        Lista de Marcas
                    </h2>
                    <!-- Botón agregar marca -->
                    <button
                        class="flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition"
                        @click="abrirCrearMarca">
                        <PlusIcon class="mr-2 h-5 w-5" />
                        Agregar Marca
                    </button>
                </div>
                <!-- Filtro de búsqueda y orden -->
                <div class="mb-4 flex flex-col md:flex-row md:items-center md:space-x-4 space-y-2 md:space-y-0">
                    <input v-model="search" type="text" placeholder="Buscar por nombre..."
                        class="border rounded px-3 py-2 w-full md:w-1/2 focus:outline-none focus:ring focus:border-indigo-300" />

                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div v-for="marca in paginatedMarcas" :key="marca.id"
                        class="rounded-xl border border-gray-200 bg-white p-4 shadow transition hover:shadow-md">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 flex items-center">
                            <TagIcon class="mr-2 h-5 w-5" />
                            {{ marca.nombre }}
                        </h3>
                        <div class="grid grid-cols-1 gap-2 text-sm mb-2">
                            <div class="flex items-center text-gray-600">
                                <CalendarPlusIcon class="mr-2 h-4 w-4" />
                                <span>Creación: {{ formatFecha(marca.created_at) }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <CalendarCheckIcon class="mr-2 h-4 w-4" />
                                <span>Actualización: {{ formatFecha(marca.updated_at) }}</span>
                            </div>
                        </div>
                        <!-- Botones de acción -->
                        <div class="flex space-x-2 mt-2">
                            <button
                                class="flex items-center px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                                @click="editarMarca(marca)" title="Editar">
                                <EditIcon class="h-4 w-4 mr-1" /> Editar
                            </button>
                            <button
                                class="flex items-center px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition"
                                @click="eliminarMarca(marca)" title="Eliminar">
                                <Trash2Icon class="h-4 w-4 mr-1" /> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Paginación -->
                <div v-if="totalPages > 1" class="flex justify-center mt-6 space-x-2">
                    <button :disabled="currentPage === 1" @click="currentPage--"
                        class="px-3 py-1 rounded border bg-gray-100 text-gray-700 hover:bg-gray-200 disabled:opacity-50">
                        Anterior
                    </button>
                    <span class="px-3 py-1 text-gray-700 font-semibold">
                        Página {{ currentPage }} de {{ totalPages }}
                    </span>
                    <button :disabled="currentPage === totalPages" @click="currentPage++"
                        class="px-3 py-1 rounded border bg-gray-100 text-gray-700 hover:bg-gray-200 disabled:opacity-50">
                        Siguiente
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div v-if="showDeleteModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
            <h3 class="text-lg font-semibold mb-4 text-red-700">
                ¿Seguro que deseas eliminar la marca "{{ marcaAEliminar?.nombre }}"?
            </h3>
            <div class="flex justify-center space-x-4 mt-6">
                <button @click="confirmarEliminar"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Sí, eliminar
                </button>
                <button @click="cancelarEliminar"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                    Cancelar
                </button>
            </div>
        </div>
    </div>

    <UpdateMarca :open="showUpdateModal" :marca="marcaSeleccionada" :categoria-id="categoriaId"
        @close="showUpdateModal = false" />
    <FormCreateMarca :open="showCreateMarcaModal" @close="showCreateMarcaModal = false" />
</template>

<script setup lang="ts">
import {
    StoreIcon,
    TagIcon,
    CalendarPlusIcon,
    CalendarCheckIcon,
    XIcon,
    EditIcon,
    Trash2Icon,
    PlusIcon,
} from 'lucide-vue-next';
import { ref, computed, watch } from 'vue';
import UpdateMarca from './UpdateMarca.vue';
import axios from 'axios';
import FormCreateMarca from './FormCreateMarca.vue';

const props = defineProps<{
    open: boolean;
    marcas: Array<{
        id: number;
        nombre: string;
        created_at?: string;
        updated_at?: string;
    }>;
    categoriaId?: number;
}>();
const emit = defineEmits(['close', 'updated']);
const showUpdateModal = ref(false);
const marcaSeleccionada = ref<any>(null);

const showDeleteModal = ref(false);
const marcaAEliminar = ref<any>(null);

const showCreateMarcaModal = ref(false);

const search = ref('');
const order = ref<'desc' | 'asc'>('desc');

function formatFecha(fecha?: string) {
    if (!fecha) return '-';
    const date = new Date(fecha);
    return date.toLocaleString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

const filteredMarcas = computed(() => {
    let result = props.marcas.filter(marca =>
        marca.nombre.toLowerCase().includes(search.value.toLowerCase())
    );
    result = result.slice().sort((a, b) => {
        const fechaA = new Date(a.created_at ?? '').getTime();
        const fechaB = new Date(b.created_at ?? '').getTime();
        return order.value === 'desc' ? fechaB - fechaA : fechaA - fechaB;
    });
    return result;
});

// Paginación de 3 elementos
const currentPage = ref(1);
const pageSize = 3;

const totalPages = computed(() => Math.ceil(filteredMarcas.value.length / pageSize));

const paginatedMarcas = computed(() => {
    const start = (currentPage.value - 1) * pageSize;
    return filteredMarcas.value.slice(start, start + pageSize);
});

// Reinicia la página cuando cambian los filtros
watch([search, order, () => props.marcas], () => {
    currentPage.value = 1;
});

// Métodos para los botones
function editarMarca(marca: any) {
    marcaSeleccionada.value = marca;
    showUpdateModal.value = true;
}

function abrirCrearMarca() {
    showCreateMarcaModal.value = true;
}

function eliminarMarca(marca: any) {
    marcaAEliminar.value = marca;
    showDeleteModal.value = true;
}

function confirmarEliminar() {
    const marca = marcaAEliminar.value;
    if (!marca?.id) return;
    axios.delete(`/marcas/${marca.id}`)
        .then(() => {
            alert('¡Marca eliminada exitosamente!');
            const idx = props.marcas.findIndex(m => m.id === marca.id);
            if (idx !== -1) props.marcas.splice(idx, 1);
            emit('updated');
        })
        .catch(error => {
            alert('Error: ' + (error.response?.data?.message || error.message));
        })
        .finally(() => {
            showDeleteModal.value = false;
            marcaAEliminar.value = null;
        });
}

function cancelarEliminar() {
    showDeleteModal.value = false;
    marcaAEliminar.value = null;
}
</script>

<style scoped>
/* Estilos adicionales si son necesarios */
</style>