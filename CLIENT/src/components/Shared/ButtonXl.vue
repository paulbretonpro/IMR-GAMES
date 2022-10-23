<template>
  <div class="button">
    <q-btn :disable="disabled" @click="handleClick">{{ label }}</q-btn>    
  </div>
</template>
<script setup lang="ts">

const props = withDefaults(
  defineProps<{
    label: string,
    disabled?: boolean
  }>(), {
    disabled: false
  }
);



const emit = defineEmits<{
  (name: 'handle-click'): void,
}>()

const handleClick = () => props.disabled ? null : emit('handle-click')

</script>

<style lang="scss" scoped>
.button {
  width: 100%;
  .q-btn {
    background-color: var(--btn-primary);
    width: 100%;
    height: 3.25rem;
    border-radius: 5px;

    text-transform: none;
    font-style: normal;
    font-weight: 900;
    font-size: 20px;
    line-height: 24px;
  }
}
</style>