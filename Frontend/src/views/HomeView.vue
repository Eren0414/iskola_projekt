<template>
  <h2>Home</h2>
  <Counter/>
</template>

<script>
import Counter from '@/components/Counter.vue';
import { useCounterStore } from '@/stores/counter';
export default {
  components: {
    Counter
  }
}
</script>

<style>

</style>