<template>
  <CarrousselRule v-if="!next"></CarrousselRule>
  <NbPlayer v-if="next" v-model:nbPlayers="nbPlayers"></NbPlayer>
  <ButtonXl :label="labelBtn" @handle-click="handleNext"></ButtonXl>
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
import { useUndercoverStore } from 'src/stores/undercover';
import { onMounted, ref, computed } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';
import ButtonXl from '../Shared/ButtonXl.vue';
import CarrousselRule from './CarrousselRule.vue';
import NbPlayer from './NbPlayer.vue';

const router = useRouter()

const gameStore = useGamesStore()
const undercoverStore = useUndercoverStore()

const { t } = useI18n()

const loader = ref(false)
const next = ref(false)

const game = computed(() => gameStore.game)

onMounted(async () => {
  loader.value = true
  if(!game.value) await gameStore.show('undercover')
  loader.value = false
})

const handleNext = async () => {
  if(next.value) {
    gameStore.fetchNbPlayer(nbPlayers.value)

    switch (game.value.code) {
      case 'undercover': {
        await undercoverStore.store()
        router.push({ name: 'new-players' })
      }
        break;
    }
  }
  next.value = true
}

const nbPlayers = ref(1)

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
  
}
</style>
<style lang="scss">
.game {
  .q-carousel__navigation-icon--active .q-icon {
    color: var(--btn-primary)
  }
}
</style>