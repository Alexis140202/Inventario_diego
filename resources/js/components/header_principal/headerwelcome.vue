<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'

const page = usePage()

</script>

<template>
  <header class="flex justify-between items-center p-6 bg-white shadow z-50">

    <div class="flex items-center space-x-2">
      <div class="w-6 h-6 rounded-full bg-sky-200 flex items-center justify-center">
        <span class="text-sky-600 font-bold text-sm">I</span>
      </div>
      <span class="font-semibold text-lg">Inventario</span>
    </div>

    <!-- Contenedor de botones centrados -->
    <div class="flex flex-1 justify-center space-x-6">
      <!-- Botón Inicio -->
      <Link :href="route('home')" :class="[
        'px-5 py-2 text-sm font-semibold rounded-full transition border',
        page.url === '/'
          ? 'bg-[#00A3FF] text-white border-[#00A3FF]'
          : 'text-[#00A3FF] border-[#00A3FF] hover:bg-[#00A3FF] hover:text-white'
      ]">
      Inicio
      </Link>

      <!-- Botón Funcionalidades -->
      <Link :href="route('funcionalidades')" :class="[
        'px-5 py-2 text-sm font-semibold rounded-full transition border',
        page.url.startsWith('/funcionalidades')
          ? 'bg-[#00A3FF] text-white border-[#00A3FF]'
          : 'text-[#00A3FF] border-[#00A3FF] hover:bg-[#00A3FF] hover:text-white'
      ]">
      Funcionalidades
      </Link>

    </div>

    <!-- Botón Login a la derecha -->
    <nav class="flex items-center justify-end gap-4">
      <Link v-if="$page.props.auth.user" :href="route('dashboard')"
        class="px-5 py-2 text-sm font-semibold rounded-full transition border border-[#00A3FF] text-[#00A3FF] bg-white hover:bg-[#00A3FF] hover:text-white">
      Dashboard
      </Link>

      <template v-else>
        <Link :href="route('login')"
          class="px-5 py-2 text-sm font-semibold rounded-full transition border border-[#00A3FF] text-[#00A3FF] bg-white hover:bg-[#00A3FF] hover:text-white">
        Log in
        </Link>
      </template>
    </nav>
  </header>
</template>
