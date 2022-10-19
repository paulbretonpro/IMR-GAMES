import { defineStore } from 'pinia';
import { LocalStorage } from 'quasar';
import { UndercoverENUM } from 'src/LocalStorageEnum/Undercover';
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
    getId: (state) => state.id || LocalStorage.getItem(UndercoverENUM.ID),
    getUndercover: (state) =>
      state.undercover || LocalStorage.getItem(UndercoverENUM.GAME),
  },
  actions: {
    async show() {
      this.undercover = await show(this.getId);
      LocalStorage.set(UndercoverENUM.GAME, this.undercover);
    },
    async store() {
      this.id = await store();
      // SET id undercover pour le reload
      LocalStorage.set(UndercoverENUM.ID, this.id);
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
      await deleteUndercover(this.getId);
    },
  },
});
