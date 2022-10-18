<template>
  <div class="nb-players">
    <div class="title">{{ t('game-nb-player-enter-nb') }}</div>
    <div class="select-nb">
      <q-select filled v-model="nbPlayersComputed" :options="options" />
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref, computed } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n() 

const options = ref([])

const props = defineProps<{
  nbPlayers: number;
}>()

const emit = defineEmits<{
  (name: 'update:nbPlayers', value: number): void;
}>();

const nbPlayersComputed = computed({
  get: () => props.nbPlayers,
  set: (nb) => emit('update:nbPlayers', nb)
})

onMounted(() => {
  for(let i=1; i<=30; i++) {
    options.value.push(i)
  }
})
</script>
<style lang="scss" scoped>
.title {
  @include title;
  margin: 2rem;
}
.nb-players {
  margin: auto 0;
  text-align: center;

  .select-nb .q-select {
    width: 100%;
  }

  .q-select {
    q-item__label {
      color: var(--btn-primary);
    }
  }
}
</style>
<style lang="scss">
.nb-players .select-nb {
  .q-field {
    background-color: white;
    border-radius: 5px;
  }
  
  .q-field__native {
    justify-content: center;
  }
}
.q-select__dialog {
    color: black;
    .q-item--active {
      color: var(--text-orange);
    }
  }
</style>