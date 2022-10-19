import { defineStore } from 'pinia';
import { getGames, showGame } from 'src/services/games';
import { Game } from 'src/models/game';
import { LocalStorage } from 'quasar';
import { useUndercoverStore } from './undercover';
import { GameENUM } from 'src/LocalStorageEnum/Game';

const undercoverStore = useUndercoverStore();

export const useGamesStore = defineStore('games', {
  state: () => ({
    games: [] as Game[],
    game: null as Game | null,
    nbPlayers: 0,
    nbNewPlayers: 1 as number,
  }),
  getters: {
    getNbPlayers: (state) =>
      state.nbPlayers || (LocalStorage.getItem(GameENUM.NBPLAYERS) as number),
    getNbNewPlayers: (state) => {
      state.nbNewPlayers = LocalStorage.getItem(
        GameENUM.NBNEWPLAYERS
      ) as number;
      return state.nbNewPlayers;
    },
    getGame: (state) =>
      state.game ? state.game : (LocalStorage.getItem(GameENUM.GAME) as Game),
  },
  actions: {
    async fetch() {
      this.games = await getGames();
    },
    async show(code: string) {
      this.game = await showGame(code);
      LocalStorage.set(GameENUM.GAME, this.game);
    },
    fetchNbPlayer(nb: number) {
      this.nbPlayers = nb;
      //SET nb_player si reload
      LocalStorage.set(GameENUM.NBPLAYERS, this.nbPlayers);
    },
    addNbNewPlayer() {
      this.nbNewPlayers = this.getNbNewPlayers ? this.getNbNewPlayers + 1 : 2;
      LocalStorage.set(GameENUM.NBNEWPLAYERS, this.nbNewPlayers);
    },
    /**
     * RESET SECTION
     */
    async resetLocalStorage() {
      switch (this.getGame.code) {
        case 'undercover':
          undercoverStore.deleteGame();
          break;
      }
      this.resetNbNewPlayers();
      this.resetNbPlayers();
      this.resetTabPlayers();
    },
    resetNbNewPlayers() {
      this.nbNewPlayers = 1;
      LocalStorage.set(GameENUM.NBNEWPLAYERS, this.nbNewPlayers);
    },
    resetNbPlayers() {
      this.nbPlayers = 0;
      LocalStorage.set(GameENUM.NBPLAYERS, 0);
    },
    resetTabPlayers() {
      LocalStorage.set(GameENUM.TABPLAYERS, []);
    },
  },
});
