<template>
  <div class="discover">
    <DiscoverMember></DiscoverMember> 
  </div>
</template>
<script lang="ts">
import DiscoverMember from 'components/Undercover/DiscoverMember.vue';
export default{
  components: {
    DiscoverMember
  }
}
</script>
<style lang="scss" scoped>
.discover {
  @include container;
}  
</style>