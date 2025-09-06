<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <header class="flex justify-between items-center p-6 bg-white shadow z-50">
    <!-- Contenedor de botones centrados -->
    <div class="flex flex-1 justify-center space-x-6">
      <!-- Botón Inicio -->
      <a href="#inicio"
        class="px-5 py-2 text-sm font-semibold text-[#00A3FF] border border-[#00A3FF] rounded-full hover:bg-[#00A3FF] hover:text-white transition">
        Inicio
      </a>

      <!-- Botón Ejemplos -->
      <a href="#ejemplos"
        class="px-5 py-2 text-sm font-semibold text-white bg-[#00A3FF] rounded-full shadow hover:bg-[#0095E0] transition">
        Ejemplos
      </a>
    </div>

    <!-- Botón Login a la derecha -->
    <nav class="flex items-center justify-end gap-4">
      <Link v-if="$page.props.auth.user" :href="route('dashboard')"
        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
      Dashboard
      </Link>
      <template v-else>
        <Link :href="route('login')"
          class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]">
        Log in
        </Link>
        <Link :href="route('register')"
          class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
        Register
        </Link>
      </template>
    </nav>
  </header>
</template>
