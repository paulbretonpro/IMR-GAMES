<template>
  <div class="title">
    <div class="title">
      Le groupe gagnant est
    </div>  
    <div class="winner">{{ t('undercover.role.winner', roleId - 1) }}</div>
  </div>
</template>
<script setup lang="ts">
import { useUndercoverStore } from 'src/stores/undercover';
import { useI18n } from 'vue-i18n';

const { t } = useI18n()

const undercoverStore = useUndercoverStore()
const roleId = undercoverStore.getWinner

</script>

<style lang="scss" scoped>
  .title {
    @include title
  }
  .winner {
    margin-top: 4rem;
    text-align: center;
    text-transform: uppercase;
    @include title;
    color: var(--text-orange);
  }
</style>