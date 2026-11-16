<script setup>
import Navbar from '@/Components/Public/Navbar.vue';
import Footer from '@/Components/Public/Footer.vue';
</script>

<template>
  <div class="min-h-screen flex flex-col bg-white text-[#17231C]">
    <Navbar />
    
    <main class="flex-grow">
      <slot />
    </main>

    <Footer />
  </div>
</template>

