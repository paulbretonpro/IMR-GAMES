<template>
  <div class="undercover">
    <div class="card-header">
      <div class="title">{{ t('undercover.title') }}</div>
      <div class="desc">{{ t('undercover.description') }}</div>
    </div>
    <ListPlayers></ListPlayers>
  </div> 
</template>
<script lang="ts">
import { useI18n } from 'vue-i18n';
import ListPlayers from './ListPlayers.vue';
export default {
    name: 'IndexUndercover',
    components: { ListPlayers },
}
</script>
<script lang="ts" setup>
const { t } = useI18n()
</script>
<style lang="scss" scoped>
.undercover {
  margin-top: 2rem;
  .card-header {
    background-color: var(--background-secondary);
    border-radius: 10px;
    padding: 1.5rem
  }
  .title {
    @include title;
    text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    margin-bottom: 1rem;
  }
  .desc {
    width: 80%;
  }

 }
</style>