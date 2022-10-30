<template>
  <div class="list-players">
    <div class="player"  v-for="(member, index) in members" :key="member.name" :class="{ 'is-selected-to-start': indexWhoStart === index, 'is-selected-to-delete': nbClick.index === index}" @touchend="handleDoubleTap(index, member)" @dblclick="handleDbClick(member)">{{ member.name }}</div>
  </div>
</template>
<script setup lang="ts">
import { LocalStorage } from 'quasar';
import { GameENUM, UndercoverENUM } from 'src/LocalStorageEnum';
import { Members } from 'src/models/undercover';
import { useUndercoverStore } from 'src/stores/undercover';
import { computed, watch, ref } from 'vue'
import { useRouter } from 'vue-router';

const router = useRouter()

const undercoverStore = useUndercoverStore()
const members = computed(() => undercoverStore.undercover?.members)

const isSelectedToDelete = ref(-1)
const nbClick = ref({
  index: -1,
  click: 0
})

const handleDbClick = (member: Members) => {
  router.push({ name: 'reveal', params: { id: member.id }})
}

const handleDoubleTap = (index: number, member: Members) => {
  if(nbClick.value.index === index) {
    isSelectedToDelete.value = index
    nbClick.value.index
    router.push({ name: 'reveal', params: { id: member.id }})
  } else {
    nbClick.value.index = index
  }
}

const handleClick = (index: number) => isSelectedToDelete.value = index 

const indexMrWhite = LocalStorage.getItem(UndercoverENUM.MRWHITEID) as number

const chooseIndexStart = (): number => {
  let index = Math.floor(Math.random() * (LocalStorage.getItem(GameENUM.NBPLAYERS) as number))
  if(index === (indexMrWhite - 1) && undercoverStore.getCurrentState === 0) {
    return chooseIndexStart()
  } else {
    return index
  }
}

const indexWhoStart = chooseIndexStart()

const findByRole = (array: Members[], role: string) => array.filter((member: Members) => member.role === role)

const nbCivilLast = computed(() => members.value ? findByRole(members.value, 'CIVIL') : [])
const nbUndercoverLast = computed(() => members.value ? findByRole(members.value, 'UNDERCOVER') : [])

const mrWhiteIsDead = computed(() => indexMrWhite > 0 ? false : true )

watch(
  mrWhiteIsDead,
  () => {
    // il reste que des civils
    if(nbUndercoverLast.value?.length === 0) {
      undercoverStore.setWinner(UndercoverENUM.CIVIL)
    } else if(nbCivilLast.value?.length === 0) {
    // il reste que des undercovers
      undercoverStore.setWinner(UndercoverENUM.UNDERCOVER)
    }
    // Par défaut
    undercoverStore.setWinner(UndercoverENUM.CIVIL)
    router.push({ name: 'end' })
  }
)

watch(
  nbCivilLast,
  () => {
    if(nbCivilLast.value?.length === 0 && mrWhiteIsDead.value) {
      undercoverStore.setWinner(UndercoverENUM.UNDERCOVER)
      router.push({ name: 'end' })
    }
  }
)

watch(
  nbUndercoverLast,
  () => {
    if(nbUndercoverLast.value?.length === 0 && mrWhiteIsDead.value) {
      undercoverStore.setWinner(UndercoverENUM.CIVIL)
      router.push({ name: 'end' })
    }
  }
)

</script>
<style lang="scss" scoped>
.list-players {
  margin-top: 2rem;
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: repeat(auto);
  gap: 1rem;
  .player {
    display: flex;
    align-items: center;
    justify-content: center;

    height: 8rem;

    background-color: var(--background-orange);
    border-radius: 5px;
    color: var(--background-primary);

    font-weight: 600;
    font-size: 14px;
    line-height: 17px;
  }

  .is-selected-to-start {
    background-color: red;
  }

  .is-selected-to-delete {
    background-color: var(--background-secondary);
  }
}
</style>