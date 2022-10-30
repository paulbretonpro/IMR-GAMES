<template>
  <q-layout>
    <div class="layout">
      <div class="back">
        <q-btn
          flat
          dense
          icon="arrow_back"
          @click="goHome"
        >
          Accueil
        </q-btn>
      </div>
      <router-view />
    </div>
  </q-layout>
</template>

<script setup lang="ts">
import { useGamesStore } from 'src/stores/games';
import { useRouter } from 'vue-router';

const router = useRouter()
const gameStore = useGamesStore()

const goHome = async () =>{
  await gameStore.resetLocalStorage()
  router.push({ path: '/' })
} 
</script>
<style lang="scss" scoped>
.q-btn {
  text-transform: none;
  border: 1px solid;
  padding: 0.5rem 1rem;
  border-color: var(--btn-color-primary);
  color: var(--text-primary);
}

.layout {
  padding: 1.5rem;
  height: 100vh;
  display: flex;
  flex-direction: column;
}

</style>