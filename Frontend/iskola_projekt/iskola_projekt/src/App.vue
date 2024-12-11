<script setup>
import { RouterLink, RouterView } from 'vue-router'
export default {

}
</script>

<template>
  <header>
    <div class="container-fluid my-border my-container">
      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/kartyak">Kártyák</RouterLink>
      </nav>
    </div>
  </header>

  <div class="my-border p-2">
    <RouterView />
  </div>
</template>

<style scoped>

</style>
