<template>
  <div class="member">
    <div class="title">Ce joueur était</div>
    <div class="role">{{ member.role }}</div>
  </div>
  <button-xl :label="t('continue')" @click="goBack"></button-xl>
</template>
<script setup lang="ts">
import ButtonXl from 'components/Shared/ButtonXl.vue'
import { Members } from 'src/models/undercover';
import { useUndercoverStore } from 'src/stores/undercover';
import { computed } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRoute, useRouter } from 'vue-router';

const { t } = useI18n() 
const route = useRoute()
const router = useRouter()
const undercoverStore = useUndercoverStore()

const memberId = parseInt(route.params.id as string) as number
const undercover = computed(() => undercoverStore.getUndercover)

const member = undercover.value?.members.find((m: Members) => m.id === memberId )

const goBack = async () => {
  await deleteMember()
  router.go(-1)
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
</style>