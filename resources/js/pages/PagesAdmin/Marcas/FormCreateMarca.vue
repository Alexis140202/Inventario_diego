<template>
    <transition name="modal-blur">
        <div v-if="open" class="bg-opacity-40 fixed inset-0 z-50 flex items-center justify-center backdrop-blur-md">
            <div class="relative mx-auto w-full max-w-3xl rounded bg-white p-6 shadow">
                <h1 class="mb-6 text-center text-2xl font-bold">Crear Categoria</h1>
                <button @click="emitClose"
                    class="absolute top-2 right-2 flex h-8 w-8 items-center justify-center rounded-full bg-red-500 text-white hover:bg-red-600"
                    title="Cerrar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <form @submit.prevent="submitForm">
                    <div class="grid grid-cols-1 md:grid-cols-2 items-start gap-6">
                        <div>
                            <div class="mb-4">
                                <label class="mb-1 block font-semibold" for="nombre"> Nombre de la categoría <span
                                        class="text-red-500">*</span> </label>
                                <input id="nombre" v-model="form.nombre" type="text"
                                    class="w-full rounded border px-3 py-2" required />
                            </div>
                            <div class="mb-4 flex items-center space-x-2">
                                <input type="checkbox" id="agregarMarcas" v-model="agregarMarcas" />
                                <label for="agregarMarcas" class="font-semibold">Agregar marcas</label>
                            </div>
                            <div v-if="agregarMarcas" class="mb-4">
                                <label class="block font-semibold mb-2 text-gray-700">Marcas para esta categoría</label>
                                <div class="flex space-x-2">
                                    <input v-model="nuevaMarca" type="text" placeholder="Nombre de la marca"
                                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 transition" />
                                    <button type="button" @click="agregarMarca"
                                        class="flex items-center space-x-1 rounded-lg bg-green-600 px-3 py-2 text-white hover:bg-green-700 transition">

                                        <PlusIcon class="w-4 h-4" />
                                    </button>
                                </div>
                                <ul class="mt-4 space-y-2">
                                    <li v-for="(marca, idx) in marcas" :key="idx"
                                        class="flex items-center justify-between rounded-lg bg-gray-100 px-3 py-2 shadow-sm">
                                        <span class="font-medium text-gray-800 flex items-center">
                                            <TagIcon class="w-4 h-4 mr-2 text-green-500" /> {{ marca }}
                                        </span>
                                        <button type="button" @click="eliminarMarca(idx)"
                                            class="flex items-center text-red-500 hover:text-red-700 transition"
                                            title="Quitar marca">
                                            <Trash2Icon class="w-4 h-4 mr-1" />
                                            <span class="text-sm">Quitar</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <button type="submit"
                                class="mt-6 w-full rounded bg-blue-600 px-4 py-2 text-white transition-colors duration-200 hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-gray-300 disabled:text-gray-500"
                                :disabled="!form.nombre.trim()">
                                Guardar Categoria
                            </button>
                        </div>
                    </div>
                </form>
                <div v-if="confirmMessage"
                    class="mb-4 rounded bg-green-100 px-4 py-2 text-green-800 text-center font-semibold">
                    {{ confirmMessage }}
                </div>
            </div>
        </div>
    </transition>
</template>

<script lang="ts" setup>
import { defineEmits, defineProps, ref } from 'vue';
import axios from 'axios';
import { PlusIcon, Trash2Icon, TagIcon } from 'lucide-vue-next';
const props = defineProps<{ open: boolean }>();
const emit = defineEmits(['close']);

const form = ref({
    nombre: '',
});
const agregarMarcas = ref(false);
const nuevaMarca = ref('');
const marcas = ref<string[]>([]);
const confirmMessage = ref<string | null>(null);

function agregarMarca() {
    if (nuevaMarca.value.trim()) {
        marcas.value.push(nuevaMarca.value.trim());
        nuevaMarca.value = '';
    }
}
function eliminarMarca(idx: number) {
    marcas.value.splice(idx, 1);
}
function emitClose() {
    emit('close');
    confirmMessage.value = null;
}
function resetForm() {
    form.value.nombre = '';
    agregarMarcas.value = false;
    nuevaMarca.value = '';
    marcas.value = [];
}
function submitForm() {
    const payload: any = { nombre: form.value.nombre };
    if (agregarMarcas.value && marcas.value.length > 0) {
        payload.marcas = marcas.value;
    }
    axios.post('/categorias', payload)
        .then(() => {
            confirmMessage.value = '¡Categoría creada exitosamente!';
            setTimeout(() => {
                resetForm();
                emitClose();
            }, 1500);
        })
        .catch(error => alert('Error: ' + error.response.data.message));
}
</script>

<style scoped>
.relative[style] {
    min-height: 180px;
}

.modal-blur-enter-active,
.modal-blur-leave-active {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.modal-blur-enter-from,
.modal-blur-leave-to {
    opacity: 0;
    filter: blur(16px) scale(0.95);
}

.modal-blur-enter-to,
.modal-blur-leave-from {
    opacity: 1;
    filter: blur(0) scale(1);
}
</style>
