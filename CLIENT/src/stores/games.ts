import { defineStore } from 'pinia';
import { getGames } from 'src/services/games';

export const useGamesStore = defineStore('games', {
  state: () => ({
    games: [],
  }),
  actions: {
    async fetch() {
      this.games = await getGames()
    },
  },
});
