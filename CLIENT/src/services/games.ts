import { api } from 'src/boot/axios';
import { Game } from 'src/models/game';

export async function getGames(): Promise<Game[]> {
  try {
    const games = await api.get('/games');
    return games.data.payload;
  } catch (error) {
    console.error(error);
    return [];
  }
}
