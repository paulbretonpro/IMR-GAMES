<template>
  <q-page class="row items-center justify-evenly">
    <q-btn @click="login">Coucou</q-btn>
  </q-page>
</template>

<script setup lang="ts">
import { getGames } from 'src/services/games';

const login = async () => {
  const games = await getGames()
}

</script>
