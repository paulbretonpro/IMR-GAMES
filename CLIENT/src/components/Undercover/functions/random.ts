import { LocalStorage } from 'quasar';
import { GameENUM, UndercoverENUM } from 'src/LocalStorageEnum';
import { Members } from 'src/models/undercover';

export function useRandom(tabPlayers: Members[]) {
  const maxIndex = LocalStorage.getItem(GameENUM.NBPLAYERS) as number;
  let nbCIVIL = (LocalStorage.getItem(UndercoverENUM.NBCIVIL) as number) || 0;
  let nbUNDERCOVER =
    (LocalStorage.getItem(UndercoverENUM.NBUNDERCOVER) as number) || 0;

  const initNbRole = () => {
    if (!nbCIVIL && !nbUNDERCOVER) {
      nbCIVIL = Math.ceil(maxIndex * 0.55);
      nbUNDERCOVER = maxIndex - nbCIVIL - 1;
    }
  };

  initNbRole();

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
    const roleId = Math.floor(Math.random() * 2) + 2;
    console.log(roleId);
    let choice;

    if (roleId === 3 && nbCIVIL > 0) {
      nbCIVIL--;
      choice = 3;
    } else if (roleId === 2 && nbUNDERCOVER > 0) {
      nbUNDERCOVER--;
      choice = 2;
    } else if (nbCIVIL > 0) {
      nbCIVIL--;
      choice = 3;
    } else if (nbUNDERCOVER > 0) {
      nbUNDERCOVER--;
      choice = 2;
    }

    setLocalstorage(nbCIVIL, nbUNDERCOVER);

    console.log('nb civil : ' + nbCIVIL + ' nb undercover : ' + nbUNDERCOVER);
    return choice;
  };

  const setLocalstorage = (nbCIVIL: number, nbUNDERCOVER: number) => {
    LocalStorage.set(UndercoverENUM.NBCIVIL, nbCIVIL);
    LocalStorage.set(UndercoverENUM.NBUNDERCOVER, nbUNDERCOVER);
  };

  const resetLocalstorage = () => {
    LocalStorage.set(UndercoverENUM.NBCIVIL, 0);
    LocalStorage.set(UndercoverENUM.NBUNDERCOVER, 0);
  };

  return {
    indexMrWhite,
    getRoleId,
    resetLocalstorage,
  };
}
