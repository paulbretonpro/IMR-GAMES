<template>
  <q-carousel
    v-model="slide"
    transition-prev="scale"
    transition-next="scale"
    swipeable
    animated
    control-color="white"
    navigation
    class="bg-transparent"
  >
    <q-carousel-slide name="rule" class="column no-wrap flex-center">
      <img src="~/assets/icons-library/undercover_undercover.svg" />
      <div class="title-caroussel">{{ t('rule') }}</div>
      <div class="q-mt-md text-center">
        {{ gameComputed?.rule ? gameComputed.rule : t('no-rule') }}
      </div>
    </q-carousel-slide>
    <q-carousel-slide v-for="role in gameRoles" :key="role.id" :name="role.id" class="column no-wrap flex-center">
      <img :src="imgSrc(role.icon)" />
      <div class="title-caroussel">{{ role.name }}</div>
      <div class="q-mt-md text-center">
        {{ role.description }}
      </div>
    </q-carousel-slide>
    
  </q-carousel>
</template>
<script setup>
import { useGamesStore } from 'src/stores/games';
import { computed, ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n()

const gameStore = useGamesStore()
const gameComputed = computed(() => gameStore.game)

const gameRoles = computed(() => gameComputed.value?.roles ? gameComputed.value.roles : [])

const slide = ref('rule')

const imgSrc = (icon) => `src/assets/icons-library/${icon}`
</script>
<style lang="scss" scoped>
.title-caroussel {
  @include title;
  margin: 2rem;
}

.q-icon {
  color: var(--text-orange);
}
img {
  width: 50%;
}
</style>
<style lang="scss">
.q-carousel__control {
  position: fixed;
  bottom: 10rem;
}
.q-field__control {
  color: var(--btn-primary);
}
</style>