<template>
  <div class="list-players">
    <div class="player" v-for="member in members" :key="member.name" @dblclick="handleDbClick(member)">{{ member.name }}</div>
  </div>
</template>
<script setup lang="ts">
import { Members } from 'src/models/undercover';
import { useUndercoverStore } from 'src/stores/undercover';
import { computed } from 'vue'

const undercoverStore = useUndercoverStore()
const members = computed(() => undercoverStore.undercover?.members)

const handleDbClick = (member: Members) => console.log(member)

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
}
</style>