<template>
  <div class="no-game">
    <div v-if="listGames.length === 0">{{ t('home-listgames-no-game') }}</div>
  </div>
  <div class="list-games">
    <div class="game" v-for="game in listGames" :key="game.id">
      {{ game.name }}
    </div>
  </div>
  <q-inner-loading
    :showing="false"
  />
</template>
<script setup>
  import { useGamesStore } from 'src/stores/games';
  import { ref, computed, onMounted } from 'vue'
  import { useI18n } from 'vue-i18n';

  const { t } = useI18n()

  const gameStore = useGamesStore()

  const listGames = computed(() => gameStore.games)
  const loader = ref(false)

  onMounted(async () => {
    loader.value = true
    //await gameStore.fetch()
    loader.value = false
  })

</script>

<style lang="scss" scoped>
.list-games {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  .game {
    background-color: var(--background-secondary);
    border-radius: 8px;
    height: 4rem;
    display: flex;
    align-items: flex-end;
    padding: 0.75rem;
    font-size: var(--text-size-lg);
    font-weight: var(--text-font-weight-xl);

    box-shadow: 0px 4px 4px rgba(53, 4, 42, 0.48);
  }
}

.no-game {
  display: flex;
  height: 100%;
  align-items: center;
  justify-content: center;
}


</style>