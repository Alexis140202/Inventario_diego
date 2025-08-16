<template>
  <div class="relative flex items-center justify-center h-48 md:h-64 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-800">
    <!-- SVG background with waves and particles -->
    <svg 
      class="absolute top-0 left-0 w-full h-full"
      viewBox="0 0 800 200" 
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="none"
    >
      <!-- Wave background -->
      <path 
        fill="#4F46E5" 
        fill-opacity="0.2" 
        d="M0,100 C150,200 350,0 500,100 C650,200 750,0 800,100 L800,200 L0,200 Z"
      />
      
      <!-- Decorative particles -->
      <circle cx="50" cy="30" r="2" fill="#FFFFFF" opacity="0.7"/>
      <circle cx="150" cy="70" r="3" fill="#FFFFFF" opacity="0.5"/>
      <circle cx="300" cy="50" r="2" fill="#FFFFFF" opacity="0.7"/>
      <circle cx="400" cy="80" r="3" fill="#FFFFFF" opacity="0.5"/>
      <circle cx="550" cy="40" r="2" fill="#FFFFFF" opacity="0.7"/>
      <circle cx="700" cy="60" r="3" fill="#FFFFFF" opacity="0.5"/>
      <circle cx="750" cy="30" r="2" fill="#FFFFFF" opacity="0.7"/>
    </svg>
    
    <!-- Main title with decorative underline -->
    <div class="relative z-10 text-center">
      <h1 class="text-4x4 md:text-5xl font-bold text-white drop-shadow-lg pb-2">
        HOLA MUNDO
      </h1>
      <svg 
        class="w-full absolute bottom-0 left-0" 
        viewBox="0 0 200 10" 
        xmlns="http://www.w3.org/2000/svg"
      >
        <path 
          d="M0,5 C50,10 150,0 200,5" 
          stroke="#4F46E5" 
          stroke-width="2" 
          fill="none" 
          stroke-linecap="round"
        />
      </svg>
    </div>
  </div>
</template>

<script setup lang="ts">
// No se necesita lógica adicional para este componente visual
</script>