<template>
  <div>
    <!-- Fejléc -->
    <div class="d-flex justify-content-between mb-3">
      <h2>Kártyák</h2>
      <div>
        <div class="select">
          kártya/oldal:
          <select class="form-select" v-model="cardsPerPage" @change="updateCardsPerPage">
            <option value="1">1</option>
            <option value="3">3</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="100">100</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Kártyák -->
    <div class="align-items-end">
      <div class="my-cards-height overflow-y-auto my-border">
        <Cards :cards="cards" />
      </div>

      <!-- Paginátor -->
      <div class="p-3 my-border">
        <Paginator :currentPage="currentPage" :totalPages="totalPages" :pagesArray="pagesArray"
          @pageChange="handlePageChange"></Paginator>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Cards from '@/components/Cards.vue';
import Paginator from '../components/Paginator.vue';
import { BASE_URL } from '@/helpers/baseUrls';
export default {
  components: {
    Cards,
    Paginator
  },
  data() {
    return {
      urlApi: "http://localhost:8000/api",
      cards: [], // Kártyák
      currentPage: 1, // Aktuális oldal
      totalPages: 1, // Összes oldal
      cardsPerPage: 3, // Kártyák száma oldalanként
      pagesArray: [] // Oldalak száma tömbben
    };
  },
  async mounted() {
    await this.getOsztalyOldal();
    await this.getOldalakSzama();
  },
  methods: {
    async getOsztalyOldal() {
      const url = `${this.urlApi}/queryOsztalyOldal/${this.currentPage}/${this.cardsPerPage}`;
      const response = await axios.get(url);
      this.cards = response.data.data;
      console.log(this.cards);
    },
    async getOldalakSzama() {
      const url = `${this.urlApi}/queryOsztalyOldalSzam/${this.cardsPerPage}`;
      const response = await axios.get(url);
      this.totalPages = response.data.data.oldalSzam;
      console.log("totalpages", this.totalPages);

      this.pagesArray = [];
      for (let i = 0; i < this.totalPages; i++) {
        this.pagesArray.push(i + 1);
      }
    },
    async updateCardsPerPage() {
      this.currentPage = 1; // Visszaállítjuk az első oldalra
      await this.getOsztalyOldal(); // Kártyák újratöltése
      await this.getOldalakSzama(); // Oldalak frissítése
    },
    async handlePageChange(newPage) {
      this.currentPage = newPage;
      await this.getOsztalyOldal();
    }
  }
};
</script>
