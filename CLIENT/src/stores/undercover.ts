import { defineStore } from 'pinia';
import { LocalStorage } from 'quasar';
import { Members, Undercover } from 'src/models/undercover';
import {
  addPlayerUndercover,
  deletePlayerUndercover,
  store,
  show,
  deleteUndercover,
} from 'src/services/undercover';

export const useUndercoverStore = defineStore('undercover', {
  state: () => ({
    undercover: {} as Undercover,
    id: 0 as number,
  }),
  getters: {
    getId: (state) => state.id || LocalStorage.getItem('UNDERCOVER_id'),
    getUndercover: (state) =>
      state.undercover || LocalStorage.getItem('UNDERCOVER_game'),
  },
  actions: {
    async show() {
      this.undercover = await show(this.getId);
      LocalStorage.set('UNDERCOVER_game', this.undercover);
    },
    async store() {
      this.id = await store();
      // SET id undercover pour le reload
      LocalStorage.set('UNDERCOVER_id', this.id);
    },
    addPlayer(player: Members) {
      addPlayerUndercover(this.getId, player);
    },
    async deletePlayer(playerId: number) {
      await deletePlayerUndercover(this.undercover.id, playerId);
    },

    setUndercoverFromLocalStorage(undercover: Undercover) {
      this.undercover = undercover;
    },
    setIdUndercoverFromLocalStorage(id: number) {
      this.id = id;
    },

    async deleteGame() {
      console.log(this.getId);
      await deleteUndercover(this.getId);
    },
  },
});
