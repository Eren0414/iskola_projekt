import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  //Ezek a változók
  state: () => ({
    id: null,
    user: null,
    token: JSON.parse(localStorage.getItem('currentToken')) || null,
  }),
  //valamilyen formában visszaadja
  getters: {},
  //csinál vele valamit
  actions: {
    setUser(user) {
      this.user = user
    },
    setToken(token) {
      localStorage.setItem('currentToken', JSON.stringify(token))
      this.token = token
    },
    clearStoredData() {
      localStorage.removeItem('currentToken');
      this.id = null;
      this.token = null;
      this.user = null;
    },
  },
});