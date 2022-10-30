<template>
  <div class="enter-name">
    <EnterName></EnterName>
  </div>
</template>
<script setup lang="ts">
import { LocalStorage } from 'quasar';
import EnterName from 'src/components/Undercover/EnterName.vue';
import { UndercoverENUM } from 'src/LocalStorageEnum';
import { Undercover } from 'src/models/undercover';
import { useUndercoverStore } from 'src/stores/undercover';
import { onMounted } from 'vue'

const undercoverStore = useUndercoverStore()

onMounted(async () => {
  if(LocalStorage.getItem(UndercoverENUM.GAME) === null) {
    const undercover = LocalStorage.getItem(UndercoverENUM.GAME) as Undercover
    undercoverStore.setUndercoverFromLocalStorage(undercover)
  } else {
    await undercoverStore.show()
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