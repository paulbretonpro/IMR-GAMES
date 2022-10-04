<template>
  <q-page class="row items-center justify-evenly">
    <q-btn @click="login">Coucou</q-btn>
  </q-page>
</template>

<script setup lang="ts">
import { api } from 'src/boot/axios';


const login = async () => {
  await api.get('/game');
}

</script>
