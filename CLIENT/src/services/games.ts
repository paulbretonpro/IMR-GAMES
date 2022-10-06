import { api } from "src/boot/axios";

export async function getGames() {
  try {
    const games = await api.get('/games');
    return games.data.payload
  } catch (error) {
    console.error(error)
  }
} 