<template>
  <q-layout class="layout">
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
  </q-layout>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router';

const router = useRouter()

const goHome = () => router.push({ path: '/' })
</script>
<style lang="scss" scoped>
.back {
  margin-bottom: 2rem;
  position: absolute;
}
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
}

</style>