<script>
import { RouterLink, RouterView } from "vue-router";
import Menu from "./components/Menu.vue";
export default {
  components: {
    Menu,
  },
  

}
</script>

<template>
  <div class="container-fluid my-border my-container">
    <h1>Iskola</h1>

    <Menu/>
    <div class="my-border p-2">
      <RouterView />
    </div>
  </div>
</template>

<style scoped>
</style>
