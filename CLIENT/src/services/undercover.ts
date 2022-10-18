import { api } from 'src/boot/axios';
import { Members } from 'src/models/undercover';

export async function show(undercoverId: number) {
  try {
    const undercover = await api.get(`/undercover/${undercoverId}`);
    return undercover.data.payload;
  } catch (error) {
    console.log(error);
  }
}

export async function store() {
  try {
    const newUndercover = await api.post('/undercover');
    return newUndercover.data.payload;
  } catch (error) {
    console.log(error);
  }
}

export function addPlayerUndercover(undercoverId: number, player: Members) {
  try {
    const newPlayer = api.post(`/undercover/${undercoverId}/members`, {
      name: player.name,
      role_id: player.role,
      word: player.word,
    });
  } catch (error) {
    throw new Error();
  }
}

export async function deleteUndercover(undercoverId: number) {
  try {
    await api.delete(`/undercover/${undercoverId}`);
  } catch (error) {
    console.log(error);
  }
}

export async function deletePlayerUndercover(
  undercoverId: number,
  playerId: number
) {
  try {
    await api.delete(`undercover/${undercoverId}/members/${playerId}`);
  } catch (error) {}
}
