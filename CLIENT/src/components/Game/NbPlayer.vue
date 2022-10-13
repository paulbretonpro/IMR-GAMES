<template>
  <div class="nb-players">
    <div class="title">{{ t('game-nb-player-enter-nb') }}</div>
    <div class="select-nb">
      <q-select filled v-model="model" :options="options" />
    </div>
  </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import { useI18n } from 'vue-i18n';
const model = ref(1)
const options = ref([])

const { t } = useI18n() 
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