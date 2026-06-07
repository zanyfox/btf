import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null //{}
  }),
  actions: {
    fetchUser(state, payload) {
      fetch('/api/user').then(response => response.json()).then(data => {
        console.log('test')
        //this.user = data
      })
    },
    updateUser(payload) {
      this.user = payload
    }
  },
  getters: {
    getUser: (state) => state.user,
  }
})
