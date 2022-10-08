<template>
  <q-layout class="layout">
    <div class="back">
      <q-btn
        flat
        dense
        icon="arrow_back"
      >
        Accueil
      </q-btn>
    </div>
    
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup lang="ts">

</script>
<style lang="scss" scoped>
.back {
  margin-bottom: 2rem;
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
}

</style>