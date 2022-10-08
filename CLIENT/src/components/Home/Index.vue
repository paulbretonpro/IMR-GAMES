<template>
  <div class="index">
    <div class="title">{{ t('home-index-welcom') }} <q-icon name="waving_hand"></q-icon></div>
    <div class="sub-title">
      {{ t('home-index-subtitle') }}
    </div>
    <ListGames />    
  </div>
</template>
<script>
  export default {
    name: 'IndexComponent'
  }
</script>
<script setup>
import ListGames from './ListGames.vue'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
</script>
<style lang="scss" scoped>

.index {
  display: flex;
  flex-direction: column;
}
.title {
  font-weight: var(--text-font-weight-xl);
  font-size: var(--text-size-xl);
  margin-bottom: 1rem;
}

.sub-title {
  color: var(--text-secondary);
  margin-right: 40%;
  font-weight: var(--text-font-weight-lg);
  font-size: var(--text-size-lg);
  margin-bottom: 3rem;
}

.q-icon {
  color: var(--btn-primary);
  margin-left: 0.5rem;
}
</style>