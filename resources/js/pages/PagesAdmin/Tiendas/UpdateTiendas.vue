<template>
    <transition name="modal-blur">
        <div v-if="open" class="bg-opacity-40 fixed inset-0 z-50 flex items-center justify-center backdrop-blur-md">
            <div class="relative mx-auto w-full max-w-3xl rounded bg-white p-6 shadow">
                <h1 class="mb-6 text-center text-2xl font-bold">Crear Tienda</h1>
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
                            <div>
                                <label class="mb-1 block font-semibold" for="descripcion">Descripción</label>
                                <textarea id="descripcion" v-model="form.descripcion"
                                    class="w-full rounded border px-3 py-2" rows="3" maxlength="200"></textarea>
                            </div>
                        </div>
                        <!-- Columna derecha: Imagen y botón -->
                        <div class="flex flex-col items-center">
                            <label class="mb-1 block font-semibold" for="foto">Foto</label>
                            <div class="relative flex w-full items-center justify-center" style="height: 180px">
                                <input id="foto" type="file" @change="handleFileUpload" accept="image/*"
                                    class="absolute top-0 left-0 mb-2 h-full w-full cursor-pointer opacity-0"
                                    :disabled="!!previewUrl" />
                                <div class="flex h-full w-full items-center justify-center rounded bg-gray-100 shadow">
                                    <img v-if="previewUrl" :src="previewUrl" alt="Previsualización"
                                        class="max-h-[160px] rounded object-contain shadow" style="max-width: 100%" />
                                    <span v-else class="text-gray-400">Selecciona una imagen</span>
                                </div>
                                <button v-if="previewUrl" type="button" @click="removeImage"
                                    class="absolute top-2 right-2 flex h-7 w-7 items-center justify-center rounded-full bg-red-500 text-white shadow hover:bg-red-600"
                                    title="Quitar imagen">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <button type="submit"
                                class="mt-6 w-full rounded bg-blue-600 px-4 py-2 text-white transition-colors duration-200 hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-gray-300 disabled:text-gray-500"
                                :disabled="!form.nombre.trim()">
                                Guardar Tienda
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

const props = defineProps<{ open: boolean, tienda?: any }>();
const emit = defineEmits(['close']);

const form = ref({
    nombre: '',
    foto: null as File | null,
    descripcion: '',
});

const previewUrl = ref<string | null>(null);
const confirmMessage = ref<string | null>(null);

function handleFileUpload(event: Event) {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        const file = target.files[0];
        form.value.foto = file;
        previewUrl.value = URL.createObjectURL(file);
    }
}

function removeImage() {
    form.value.foto = null;
    previewUrl.value = null;
}

function emitClose() {
    emit('close');
    confirmMessage.value = null;
}
function resetForm() {
    form.value.nombre = '';
    form.value.descripcion = '';
    form.value.foto = null;
    previewUrl.value = null;
}
function submitForm() {
    if (!props.tienda || !props.tienda.id) return;

    const formData = new FormData();
    formData.append('nombre', form.value.nombre);
    formData.append('descripcion', form.value.descripcion);

    // Si se seleccionó una nueva imagen
    if (form.value.foto) {
        formData.append('imagen', form.value.foto);
    } else if (!previewUrl.value) {
        // Si se quitó la imagen, enviar imagen como null
        formData.append('imagen', '');
    }

    axios.post(`/tiendas/${props.tienda.id}`, formData, {
        headers: { 'X-HTTP-Method-Override': 'PUT' }
    })
        .then(() => {
            confirmMessage.value = '¡Tienda actualizada exitosamente!';

            setTimeout(() => {
                resetForm();
                emitClose();
            }, 1500);

        })
        .catch(error => alert('Error: ' + error.response.data.message));
}

watch(() => props.tienda, (newTienda) => {
    if (newTienda) {
        form.value.nombre = newTienda.nombre || '';
        form.value.descripcion = newTienda.descripcion || '';
        form.value.foto = null;
        previewUrl.value = newTienda.foto || (newTienda.imagen ? `/storage/${newTienda.imagen}` : null);
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
