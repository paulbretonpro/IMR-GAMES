<template>
  <div class="game">
    <CarrousselRule v-if="!next"></CarrousselRule>
    <NbPlayer v-if="next"></NbPlayer>
    <ButtonXl :label="labelBtn" @handle-click="handleNext"></ButtonXl>
  </div>
  <q-inner-loading
    :showing="loader"
  />
</template>
<script>
export default {
  name: 'IndexGame'
}
</script>
<script setup>
import { useGamesStore } from 'src/stores/games';
import { onMounted, ref, computed } from 'vue';
import { useI18n } from 'vue-i18n';
import ButtonXl from '../Shared/ButtonXl.vue';
import CarrousselRule from './CarrousselRule.vue';
import NbPlayer from './NbPlayer.vue';

const gameStore = useGamesStore()
const { t } = useI18n()

const loader = ref(false)
const next = ref(false)

onMounted(async () => {
  loader.value = true
  await gameStore.show('undercover')
  loader.value = false
})

const handleNext = () => next.value = true

const labelBtn = computed(() => next.value ? t('play') : t('continue'))
</script>
<style lang="scss" scoped>
.game {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  .q-carousel {
    margin: auto;
  } 
  
  .button {
    margin-bottom: 2rem;
  }
}
</style>
<style lang="scss">
.game {
  .q-carousel__navigation-icon--active .q-icon {
    color: var(--btn-primary)
  }
}
</style>