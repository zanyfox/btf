import { defineStore } from 'pinia'

export const useSettingsStore = defineStore('settings', {
  state: () => ({
    appLangs: [
      { id: 1, name: 'Русский', code: 'ru' },
      { id: 2, name: 'English', code: 'en' },
      { id: 3, name: 'Español', code: 'es' }
    ],
    appCurrencies: [
      { id: 1, name: 'Рубль', code: 'RUB' },
      { id: 2, name: 'Доллар', code: 'USD' },
      { id: 3, name: 'Евро', code: 'EUR' }
    ],
    appSettings: [
      { id: 1, name: 'Тема', value: 'тёмная' },
      { id: 2, name: 'Язык', value: 'русский' },
      { id: 3, name: 'Уведомления', value: 'включены' }
    ]
  }),
  actions: {
    updateLangs(newLangs) {
      this.appLangs = newLangs
    },
    updateCurrencies(newCurrencies) {
      this.appCurrencies = newCurrencies
    },
    updateSettings(newSettings) {
      this.appSettings = newSettings
    }
  },
  getters: {
    getSettings: (state) => state.appSettings,
    getLangs: (state) => state.appLangs,
    getCurrencies: (state) => state.appCurrencies,
  }
})
