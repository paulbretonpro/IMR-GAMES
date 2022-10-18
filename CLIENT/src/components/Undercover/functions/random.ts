import { LocalStorage } from 'quasar';
import { Members } from 'src/models/undercover';

export function useRandom(tabPlayers: Members[]) {
  const maxIndex = LocalStorage.getItem('GAME_nbPlayers') as number;

  const getIdMrWhite = () => {
    const indexMrWhite = LocalStorage.getItem('UNDERCOVER_idMrWhite');
    if (!indexMrWhite) {
      return Math.floor(Math.random() * maxIndex) + 1;
    } else {
      return indexMrWhite;
    }
  };

  const indexMrWhite = getIdMrWhite();

  /**
   * @return number (rand [2, 3])
   */
  const getRoleId = () => {
    if (tabPlayers.map((p) => p.role).includes(3)) {
      return 2;
    } else if (tabPlayers.map((p) => p.role).includes(2)) {
      return 3;
    } else {
      return Math.floor(Math.random() * 2) + 2;
    }
  };

  return {
    indexMrWhite,
    getRoleId,
  };
}
