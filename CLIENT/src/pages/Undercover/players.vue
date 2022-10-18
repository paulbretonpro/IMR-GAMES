<template>
  <div class="enter-name">
    <EnterName></EnterName>
  </div>
</template>
<script setup lang="ts">
import { LocalStorage } from 'quasar';
import EnterName from 'src/components/Undercover/EnterName.vue';
import { Undercover } from 'src/models/undercover';
import { useUndercoverStore } from 'src/stores/undercover';
import { onMounted, computed } from 'vue'

const undercoverStore = useUndercoverStore()
const undercover = computed(() => undercoverStore.undercover)

onMounted(async () => {
  if(LocalStorage.getItem('UNDERCOVER_game')) {
    const undercover = LocalStorage.getItem('UNDERCOVER_game') as Undercover
    undercoverStore.setUndercoverFromLocalStorage(undercover)
  } else {
    await undercoverStore.show()
    LocalStorage.set('UNDERCOVER_game', undercover.value)
  }
})
</script>

<script lang="ts">
export default {
  name: 'PlayerPage'
}
</script>
<style lang="scss">
.enter-name {
  @include container; 
}

</style>