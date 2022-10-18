<template>
  <Undercover></Undercover>
</template>
<script lang="ts">
import Undercover from 'src/components/Undercover/Index.vue';
import { useUndercoverStore } from 'src/stores/undercover';
import { onMounted } from 'vue';
  export default {
    name: 'indexUndercover',
    components: { Undercover }
}
</script>
<script setup lang="ts">
  const undercoverStore = useUndercoverStore()
  onMounted(async () => await undercoverStore.show())
</script>
