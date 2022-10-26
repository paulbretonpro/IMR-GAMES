import { LocalStorage } from 'quasar';
import { GameENUM, UndercoverENUM } from 'src/LocalStorageEnum';
import { Members } from 'src/models/undercover';

export function useRandom(tabPlayers: Members[]) {
  const maxIndex = LocalStorage.getItem(GameENUM.NBPLAYERS) as number;

  const setNbCivil = (nb: number) =>
    LocalStorage.set(UndercoverENUM.NBCIVIL, nb);

  const setIdMrWhite = (id: number) =>
    LocalStorage.set(UndercoverENUM.MRWHITEID, id);

  const setNbUndercover = (nb: number) =>
    LocalStorage.set(UndercoverENUM.NBUNDERCOVER, nb);

  let nbCIVIL = (LocalStorage.getItem(UndercoverENUM.NBCIVIL) as number) || 0;
  let nbUNDERCOVER =
    (LocalStorage.getItem(UndercoverENUM.NBUNDERCOVER) as number) || 0;

  const initNbRole = () => {
    if (!nbCIVIL && !nbUNDERCOVER) {
      nbUNDERCOVER = Math.floor((maxIndex - 1) * 0.55);
      nbCIVIL = maxIndex - nbUNDERCOVER - 1;
    }
  };

  initNbRole();

  const getIdMrWhite = () => {
    const indexMrWhite = LocalStorage.getItem(UndercoverENUM.MRWHITEID);
    if (!indexMrWhite) {
      const id = Math.floor(Math.random() * maxIndex) + 1;
      setIdMrWhite(id);
      return;
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

    return choice;
  };

  const setLocalstorage = (nbCIVIL: number, nbUNDERCOVER: number) => {
    setNbCivil(nbCIVIL);
    setNbUndercover(nbUNDERCOVER);
  };

  const resetLocalstorage = () => {
    LocalStorage.set(UndercoverENUM.NBCIVIL, 0);
    LocalStorage.set(UndercoverENUM.NBUNDERCOVER, 0);
  };

  return {
    indexMrWhite,
    getRoleId,
    resetLocalstorage,
    setNbCivil,
    setNbUndercover,
    nbCIVIL,
    nbUNDERCOVER,
  };
}
