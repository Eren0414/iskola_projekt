<template>
  <div>
    <h2>Kártyák</h2>
    <!-- Fejléc -->



    <!-- Kártyák -->
    <Cards
      :rows="rows"
    
    ></Cards>


    <!-- Paginátor -->
  </div>
</template>

<style>

</style>

<script>
import axios from 'axios';
import Cards from '@/components/Cards.vue';
export default {
  components: {
    Cards
  },
  data(){
    return {
      urlApi: "http://localhost:8000/api",
      rows: [],
      currentPage: 1,
      cardsPerPage: 6
    };
  },
  async mounted() {
    this.getOsztalynevsor()
  },
  methods: {
    async getOsztalynevsor(){
      const url = `${this.urlApi}/queryOsztalyOldal/${this.currentPage}/${this.cardsPerPage}`
      const response = await axios.get(url);
      this.rows = response.data.data;
      console.log(this.rows);
      
    }
  }
}
</script>
