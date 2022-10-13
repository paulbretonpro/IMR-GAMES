import { defineStore } from 'pinia';
import { getGames, showGame } from 'src/services/games';
import { Game } from 'src/models/game';

export const useGamesStore = defineStore('games', {
  state: () => ({
    games: [] as Game[],
    game: null as Game | null,
  }),
  actions: {
    async fetch() {
      this.games = await getGames();
    },
    async show(code: string) {
      this.game = await showGame(code);
    },
  },
});
