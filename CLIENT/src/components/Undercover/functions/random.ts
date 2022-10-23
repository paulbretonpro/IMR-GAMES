import { LocalStorage } from 'quasar';
import { GameENUM, UndercoverENUM } from 'src/LocalStorageEnum';
import { Members } from 'src/models/undercover';

export function useRandom(tabPlayers: Members[]) {
  const maxIndex = LocalStorage.getItem(GameENUM.NBPLAYERS) as number;

  const getIdMrWhite = () => {
    const indexMrWhite = LocalStorage.getItem(UndercoverENUM.MRWHITEID);
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
    return 2;
  };

  return {
    indexMrWhite,
    getRoleId,
  };
}
