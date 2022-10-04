<template>
  <router-view />
</template>

<script setup lang="ts">

import { api } from './boot/axios';

const token = api.get('http://127.0.0.1:8000/sanctum/csrf-cookie').then((response) => console.log(response));

</script>
