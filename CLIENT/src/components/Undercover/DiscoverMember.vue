<template>
  <div class="member">
    <div class="title">{{ titleComputed }}</div>
    <div class="role">{{ member.role }}</div>
  </div>
  <div class="btn">
    <button-xl :label="t('undercover.reveal.btn.find.word')" icon-right="fa-solid fa-arrow-right-long" v-if="isMrWhite" @click="goFindWord"></button-xl>
    <button-xl :label="t('continue')" v-if="!isMrWhite" @click="goBack"></button-xl>
  </div>
</template>
<script setup lang="ts">
import ButtonXl from 'components/Shared/ButtonXl.vue'
import { Members } from 'src/models/undercover';
import { useUndercoverStore } from 'src/stores/undercover';
import { computed, ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRoute, useRouter } from 'vue-router';

const { t } = useI18n() 
const route = useRoute()
const router = useRouter()
const undercoverStore = useUndercoverStore()

const memberId = parseInt(route.params.id as string) as number
const undercover = computed(() => undercoverStore.getUndercover)

const member = undercover.value?.members.find((m: Members) => m.id === memberId)

const isMrWhite = computed(() => member?.role === 'Mr WHITE')
const pageFind = ref(false)

const titleComputed = computed(() => pageFind.value ? t('undercover.reveal.title.find.word') : t('undercover.reveal.title'))

const goBack = async () => {
  await deleteMember()
  router.go(-1)
} 

const goFindWord = () => {
  router.push({ name: 'find-word', params: { id: memberId} })
}

const deleteMember = async () =>{
  await undercoverStore.deletePlayer(memberId)
} 
</script>
<style lang="scss" scoped>
  .member {
    margin: auto;
    .title {
      @include title;
    }
    .role {
      margin-top: 4rem;
      text-align: center;
      text-transform: uppercase;
      @include title;
      color: var(--text-orange);
    }
  }
  .btn {
    display: flex;
    gap: 1rem;
  }
</style>
