<template>
  <div class="game">
    <Game></Game>
  </div>
</template>
<script>
import Game from 'src/components/Game/Index.vue';
  export default {
    name: 'indexGame',
    components: { Game }
}
</script>
<style lang="scss" scoped>
  .game {
    @include container;
  }
</style>
