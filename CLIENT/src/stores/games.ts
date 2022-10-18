import { defineStore } from 'pinia';
import { getGames, showGame } from 'src/services/games';
import { Game } from 'src/models/game';
import { LocalStorage } from 'quasar';
import { useUndercoverStore } from './undercover';

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
      state.nbPlayers || (LocalStorage.getItem('GAME_nbPlayers') as number),
    getNbNewPlayers: (state) => {
      state.nbNewPlayers = LocalStorage.getItem('GAME_nbNewPlayers') as number;
      return state.nbNewPlayers;
    },
    getGame: (state) =>
      state.game ? state.game : (LocalStorage.getItem('GAME_game') as Game),
  },
  actions: {
    async fetch() {
      this.games = await getGames();
    },
    async show(code: string) {
      this.game = await showGame(code);
      LocalStorage.set('GAME_game', this.game);
    },
    fetchNbPlayer(nb: number) {
      this.nbPlayers = nb;
      //SET nb_player si reload
      LocalStorage.set('GAME_nbPlayers', this.nbPlayers);
    },
    addNbNewPlayer() {
      this.nbNewPlayers = this.getNbNewPlayers ? this.getNbNewPlayers + 1 : 2;
      LocalStorage.set('GAME_nbNewPlayers', this.nbNewPlayers);
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
      LocalStorage.set('GAME_nbNewPlayers', this.nbNewPlayers);
    },
    resetNbPlayers() {
      this.nbPlayers = 0;
      LocalStorage.set('GAME_nbPlayers', 0);
    },
    resetTabPlayers() {
      LocalStorage.set('UNDERCOVER_tabPlayers', []);
    },
  },
});
