<template>
  <div>
    <div class="title">{{ t('undercover.reveal.title.find.word') }}</div>
  </div>
  <div class="btn">
    <ButtonXl :label="t('btn.no')" @handle-click="goGame"></ButtonXl>
    <ButtonXl :label="t('btn.yes')"  @handle-click="goWinner"></ButtonXl>
  </div>
</template>
<script setup lang="ts">
  import { LocalStorage } from 'quasar';
  import { UndercoverENUM } from 'src/LocalStorageEnum';
  import { useUndercoverStore } from 'src/stores/undercover';
  import { useI18n } from 'vue-i18n';
  import { useRoute, useRouter } from 'vue-router';
  import ButtonXl from '../Shared/ButtonXl.vue';
  
  const { t } = useI18n()
  const undercoverStore = useUndercoverStore()
  const route = useRoute()
  const router = useRouter()
  
  const memberId = parseInt(route.params.id as string) as number

  const goGame = async () => {
    await undercoverStore.deletePlayer(memberId)
    // pour dire que mr white est mort
    LocalStorage.set(UndercoverENUM.MRWHITEID, 0)
    router.push({ name: 'indexUndercover', params: { id: undercoverStore.getId }})
  }

  const goWinner = () => {
    undercoverStore.setWinner(1)
    router.push({ name: 'end' })
  }
</script>
<style lang="scss" scoped>
.title {
  @include title;
}
.btn {
  display: flex;
  gap: 1rem;
}
</style>