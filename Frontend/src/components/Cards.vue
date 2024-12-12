<template>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col" v-for="(row, index) in rows" :key="index">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ row.osztalyNev }}</h5>
              <p class="card-text">{{ row.nev }}</p>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
export default {
    props: ["rows"]
}
</script>

<style>

</style>