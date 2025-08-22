<template>
    <transition name="modal-blur">
        <div v-if="open" class="bg-opacity-40 fixed inset-0 z-50 flex items-center justify-center backdrop-blur-md">
            <div class="relative mx-auto w-full max-w-3xl rounded bg-white p-6 shadow">
                <h1 class="mb-6 text-center text-2xl font-bold">
                    {{ props.marca ? 'Editar Marca' : 'Agregar Marca' }}
                </h1>
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
                    <div class="grid grid-cols-2 items-start gap-6">
                        <!-- Columna izquierda: Nombre y Descripción -->
                        <div>
                            <div class="mb-4">
                                <label class="mb-1 block font-semibold" for="nombre"> Nombre de la tienda <span
                                        class="text-red-500">*</span> </label>
                                <input id="nombre" v-model="form.nombre" type="text"
                                    class="w-full rounded border px-3 py-2" required />
                            </div>

                        </div>
                        <!-- Columna derecha: Imagen y botón -->
                        <div class="flex flex-col items-center">

                            <button type="submit"
                                class="mt-6 w-full rounded bg-blue-600 px-4 py-2 text-white transition-colors duration-200 hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-gray-300 disabled:text-gray-500"
                                :disabled="!form.nombre.trim() || actualizando">
                                {{ actualizando ? (props.marca ? 'Actualizando...' : 'Agregando...') : (props.marca ?
                                    'Actualizar Marca' : 'Agregar Marca') }}
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
import { defineEmits, defineProps, ref, watch } from 'vue';
import axios from 'axios';

const props = defineProps<{ open: boolean, marca?: any, categoriaId?: number }>();
const emit = defineEmits(['close']);

const form = ref({
    nombre: '',
});
const confirmMessage = ref<string | null>(null);
const actualizando = ref(false);

function emitClose() {
    emit('close');
    confirmMessage.value = null;
}
function resetForm() {
    form.value.nombre = '';
}
function submitForm() {
    actualizando.value = true;
    if (props.marca && props.marca.id) {
        // Editar marca
        axios.put(`/marcas/${props.marca.id}`, { nombre: form.value.nombre })
            .then(() => {
                confirmMessage.value = '¡Marca actualizada exitosamente!';
                setTimeout(() => {
                    resetForm();
                    emitClose();
                }, 1500);
            })
            .catch(error => alert('Error: ' + error.response.data.message))
            .finally(() => {
                actualizando.value = false;
            });
    } else {
        // Agregar marca
        axios.post('/marcas', { nombre: form.value.nombre, categoria_id: props.categoriaId })
            .then(() => {
                confirmMessage.value = '¡Marca agregada exitosamente!';
                setTimeout(() => {
                    resetForm();
                    emitClose();
                }, 1500);
            })
            .catch(error => alert('Error: ' + error.response.data.message))
            .finally(() => {
                actualizando.value = false;
            });
    }
}

watch(() => props.marca, (newMarca) => {
    if (newMarca) {
        form.value.nombre = newMarca.nombre || '';
    } else {
        resetForm();
    }
}, { immediate: true });
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
