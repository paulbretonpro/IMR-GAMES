<template>
  <div class="new-player">
    <div class="title">{{ title }}</div>
    <div class="input-name" v-if="!displayWord">
      <q-input filled v-model="name" />
    </div>
    <div class="display-word" v-if="displayWord">{{ word }}</div>
  </div>
  <button-xl :disabled="disableBtn" :label="labelBtn" @handle-click="handleClick"></button-xl>
</template>
<script setup lang="ts">
import { LocalStorage } from 'quasar';
import { GameENUM, UndercoverENUM } from 'src/LocalStorageEnum';
import { Members } from 'src/models/undercover';
import { useGamesStore } from 'src/stores/games';
import { useUndercoverStore } from 'src/stores/undercover';
import { ref, computed, onMounted } from 'vue'
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';
import ButtonXl from '../Shared/ButtonXl.vue';
import { useRandom } from './functions/random';

const tabPlayersRoleWord = ref<Members[]>([])

const { t } = useI18n()

onMounted(() => {
  const tabLocalStorage = LocalStorage.has(UndercoverENUM.GAME)
  if(!tabLocalStorage) {
    // initialisation tabPlayers
    LocalStorage.set(GameENUM.TABPLAYERS, [])
  } else {
    tabPlayersRoleWord.value = LocalStorage.getItem(GameENUM.TABPLAYERS) as Members[]
  }
})

const undercoverStore = useUndercoverStore()
const gameStore = useGamesStore()
const route = useRouter()

const undercover = computed(() => undercoverStore.getUndercover)

const nbPlayers = computed(() => gameStore.getNbPlayers)
const nbNewPlayers = computed(() => gameStore.getNbNewPlayers || 1)
const name = ref('')
const disableBtn = computed(() => name.value === '' && !displayWord.value)
const newPlayer = ref<Members>({
  name: '',
  role: 0,
  word: '',
})
const displayWord = ref(false)

const title = computed(() => displayWord.value ? t('undercover.enter.name.word.is') : t('game.enter.name'))
const word = computed(() => newPlayer.value.word === '' ? t('undercover.show.word') : newPlayer.value.word)
const labelBtn = computed(() => displayWord.value ? t('continue') : t('undercover.label.button.add.members', { nbNewPlayers: nbNewPlayers.value, nbPlayers: nbPlayers.value}))

const { indexMrWhite, getRoleId } = useRandom(tabPlayersRoleWord.value)

const handleClick = async () => {
  if(displayWord.value) {
    displayWord.value = false
  } else {
    newPlayer.value = createPlayer()
    
    const playerIsAdd = await undercoverStore.addPlayer(newPlayer.value)

    if(playerIsAdd) {
      addPlayerLocalstorage(newPlayer.value)
      
      name.value = ''
      
      gameStore.addNbNewPlayer()      
      
      
      displayWord.value = true
    }    

  }
  if(nbNewPlayers.value > nbPlayers.value){
    route.push({
      name: 'indexUndercover'
    })   
  }
}

const createPlayer = () => {
  const player = {
    name: name.value,
    role: 0,
    word: '',
  }

  if(indexMrWhite === nbNewPlayers.value) {
    player.role = 1;
  } else {
    const roleId = getRoleId()
    player.role = roleId
    player.word = player.role === 2 ? undercover.value.words.good : undercover.value.words.fake;
  }
  
  return player
}

const addPlayerLocalstorage = (player: Members) => {
  const tabAlreadyStore = LocalStorage.getItem(GameENUM.TABPLAYERS) as Members[]
  tabAlreadyStore.push(player)
  LocalStorage.set(GameENUM.TABPLAYERS, tabAlreadyStore)
  tabPlayersRoleWord.value.push(player)
}

</script>
<style lang="scss" scoped>
.new-player {
  width: 100%;
}
.title {
  @include title;
  text-align: center;
  margin: 2rem;
}
.input-name {
  margin-top: 4rem;
  width: 100%;
}

.display-word {
  margin-top: 4rem;
  text-align: center;
  text-transform: uppercase;
  @include title;
  color: var(--text-orange);
}


</style>
<style lang="scss">
.input-name {
  .q-field__native {
    color: white;
    text-align: center;
  }
  .q-field__control {
    color: var(--btn-primary);
  }
}
</style>
