<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <RouterLink class="navbar-brand" to="/">Iskola</RouterLink>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <RouterLink class="nav-link active" aria-current="page" to="/"
              >Home</RouterLink
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Counter ({{ state.paddedCount }})</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Iskola
            </a>
            <ul class="dropdown-menu">
              <li>
                <RouterLink class="dropdown-item" to="/kartyak"
                  >Kártyák</RouterLink
                >
              </li>
              <li>
                <a class="dropdown-item" href="/diakkeres">Tanuló keresés</a>
              </li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <a class="dropdown-item" href="/sportok" v-if="stateAuth.user"
                  >Sportok</a
                >
              </li>
              <li>
                <a class="dropdown-item" href="/osztalyok" v-if="stateAuth.user"
                  >Osztályok</a
                >
              </li>
              <li>
                <a class="dropdown-item" href="/diakok" v-if="stateAuth.user"
                  >Tanulók</a
                >
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="bi bi-person"></i>
              <span v-if="stateAuth.user"> {{ stateAuth.user }}</span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <RouterLink
                  class="dropdown-item"
                  to="/login"
                  v-if="!stateAuth.user"
                  >Login</RouterLink
                >
              </li>
              <li>
                <a class="dropdown-item" href="#" v-if="stateAuth.user" @click="logout()"
                  >Logout</a
                >
              </li>
              <li>
                <RouterLink
                  class="dropdown-item"
                  to="/registration"
                  v-if="!stateAuth.user"
                  >Regisztráció</RouterLink
                >
              </li>
              <li>
                <RouterLink
                  class="dropdown-item"
                  to="/profile"
                  v-if="stateAuth.user"
                  >Profil</RouterLink
                >
              </li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</template>

<script>
import { RouterLink } from "vue-router";
import { useCounterStore } from "@/stores/counter";
import { useAuthStore } from "@/stores/useAuthStore";
import axios from "axios";
import { BASE_URL } from "@/helpers/baseUrls";
export default {
  data() {
    return {
      state: useCounterStore(),
      stateAuth: useAuthStore(),
    };
  },
  methods: {
    async logout() {
      const url = `${BASE_URL}/users/logout`;
      const headers = {
        Accept: "application/json",
        Authorizaton: `Bearer ${this.stateAuth.token}`,
      };
      try {
        const response = await axios.post(url, null, headers);
      } catch (error) {
        console.log(error);
      }
      console.log("logout");
      this.stateAuth.clearStoredData();
      this.$router.push("/");
    },
  },
};
</script>

<style>
</style>