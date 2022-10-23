import { errorAlreadyExist } from 'src/assets/utils/Notify';
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

export async function addPlayerUndercover(
  undercoverId: number,
  player: Members
) {
  try {
    const newPlayer = await api.post(`/undercover/${undercoverId}/members`, {
      name: player.name,
      role_id: player.role,
      word: player.word,
    });
    return newPlayer.data.payload;
  } catch (error) {
    errorAlreadyExist(`Le joueur ${player.name}`);
    return false;
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
