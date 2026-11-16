<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  links: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div v-if="links && links.length > 3" class="flex flex-wrap justify-center items-center gap-1.5 mt-10">
    <template v-for="(link, index) in links" :key="index">
      <div
        v-if="link.url === null"
        class="px-3.5 py-2 text-xs sm:text-sm font-medium text-[#647067]/50 border border-transparent rounded-lg cursor-not-allowed select-none"
        v-html="link.label"
      />
      <Link
        v-else
        :href="link.url"
        class="px-3.5 py-2 text-xs sm:text-sm font-semibold rounded-lg transition-colors border"
        :class="link.active
          ? 'bg-[#14532D] text-white border-[#14532D]'
          : 'bg-white text-[#17231C] border-[#E5EAE5] hover:bg-[#F7FAF7] hover:border-[#14532D]/30'"
        v-html="link.label"
      />
    </template>
  </div>
</template>

