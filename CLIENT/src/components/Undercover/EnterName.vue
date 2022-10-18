<template>
  <div class="new-player">
    <div class="title">{{ title }}</div>
    <div class="input-name" v-if="!displayWord">
      <q-input filled v-model="name" />
    </div>
    <div class="display-word" v-if="displayWord">{{ word }}</div>
  </div>
  <button-xl :label="labelBtn" @click="handleClick"></button-xl>
</template>
<script setup lang="ts">
import { LocalStorage } from 'quasar';
import { UndercoverENUM } from 'src/LocalStorage/Undercover';
import { Members } from 'src/models/undercover';
import { useGamesStore } from 'src/stores/games';
import { useUndercoverStore } from 'src/stores/undercover';
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router';
import ButtonXl from '../Shared/ButtonXl.vue';
import { useRandom } from './functions/random';

const tabPlayersRoleWord = ref<Members[]>([])

onMounted(() => {
  const tabLocalStorage = LocalStorage.has(UndercoverENUM.GAME)
  if(!tabLocalStorage) {
    // initialisation tabPlayers
    LocalStorage.set(UndercoverENUM.TABPLAYERS, [])
  } else {
    console.log(LocalStorage.getItem(UndercoverENUM.TABPLAYERS) as Members[])
    tabPlayersRoleWord.value = LocalStorage.getItem(UndercoverENUM.TABPLAYERS) as Members[]
  }
})

const undercoverStore = useUndercoverStore()
const gameStore = useGamesStore()
const route = useRouter()

const undercover = computed(() => undercoverStore.getUndercover)

const nbPlayers = computed(() => gameStore.getNbPlayers)
const nbNewPlayers = computed(() => gameStore.getNbNewPlayers || 1)
const name = ref('')
const newPlayer = ref<Members>({
  name: '',
  role: 0,
  word: '',
})
const displayWord = ref(false)

const title = computed(() => displayWord.value ? 'Votre mot est :' : 'Entrez votre nom de joueur')
const word = computed(() => newPlayer.value.word === '' ? 'Pas de mot' : newPlayer.value.word)
const labelBtn = computed(() => displayWord.value ? 'Continuez !' : `Ajouter joueur ${nbNewPlayers.value} / ${nbPlayers.value}`)

const { indexMrWhite, getRoleId } = useRandom(tabPlayersRoleWord.value)

const handleClick = () => {
  if(displayWord.value) {
    displayWord.value = false
  } else {
    newPlayer.value = addPlayer()
    undercoverStore.addPlayer(newPlayer.value)
    
    addPlayerLocalstorage(newPlayer.value)
    
    name.value = ''

    gameStore.addNbNewPlayer()
    
    if(nbNewPlayers.value > nbPlayers.value){
      route.push({
        name: 'indexUndercover'
      })   
    }
    displayWord.value = true
  }
}

const addPlayer = () => {
  const player = {
    name: name.value,
    role: 0,
    word: '',
  }

  if(indexMrWhite === nbNewPlayers.value) {
    player.role = 1;
  } else {
    player.role = getRoleId()
    player.word = player.role === 2 ? undercover.value.words.good : undercover.value.words.fake;
  }
  
  return player
}

const addPlayerLocalstorage = (player: Members) => {
  const tabAlreadyStore = LocalStorage.getItem(UndercoverENUM.TABPLAYERS) as Members[]
  tabAlreadyStore.push(player)
  LocalStorage.set(UndercoverENUM.TABPLAYERS, tabAlreadyStore)
  tabPlayersRoleWord.value.push(player)
}

</script>
<style lang="scss" scoped>
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
}
</style>
