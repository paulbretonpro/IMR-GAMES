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
    winner: 0,
  }),
  getters: {
    getId: (state) => state.id || LocalStorage.getItem(UndercoverENUM.ID),
    getCurrentState: () => LocalStorage.getItem(UndercoverENUM.CURRENTSTATE) as number || 0,
    getWinner: (state) =>
      state.winner || (LocalStorage.getItem(UndercoverENUM.END) as number),
    getUndercover: (state) =>
      Object.keys(state.undercover).length === 0
        ? LocalStorage.getItem(UndercoverENUM.GAME)
        : state.undercover,
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
    async addPlayer(player: Members) {
      return await addPlayerUndercover(this.getId, player);
    },
    async deletePlayer(playerId: number) {
      let currentState = this.getCurrentState
      this.setCurrentState(currentState++)
      await deletePlayerUndercover(this.undercover.id, playerId);
    },

    setUndercoverFromLocalStorage(undercover: Undercover) {
      this.undercover = undercover;
    },
    setIdUndercoverFromLocalStorage(id: number) {
      this.id = id;
    },
    setWinner(id: number) {
      this.winner = id;
      LocalStorage.set(UndercoverENUM.END, id);
    },
    setCurrentState(nb: number) {
      LocalStorage.set(UndercoverENUM.CURRENTSTATE, nb)
    },

    async deleteGame() {
      await deleteUndercover(this.getId);
    },
    resetUndercoverGame() {
      LocalStorage.set(UndercoverENUM.GAME, {});
      this.resetNbCivil();
      this.resetNbUndercover();
      this.resetWinner();
      this.resetIndexMrWhite();
      this.resetCurrentState();
    },
    resetNbCivil() {
      LocalStorage.set(UndercoverENUM.NBCIVIL, 0);
    },
    resetNbUndercover() {
      LocalStorage.set(UndercoverENUM.NBUNDERCOVER, 0);
    },
    resetIndexMrWhite() {
      LocalStorage.set(UndercoverENUM.MRWHITEID, 0)
    },
    resetWinner() {
      this.winner = 0;
      LocalStorage.set(UndercoverENUM.END, 0);
    },
    resetCurrentState() {
      LocalStorage.set(UndercoverENUM.CURRENTSTATE, 0)
    }
  },
});
