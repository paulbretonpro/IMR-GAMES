<template>
  <router-view />
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { api } from './boot/axios';

onMounted(async () => {
  const token = await api.get('http://127.0.0.1:8000/sanctum/csrf-cookie');
})
</script>
