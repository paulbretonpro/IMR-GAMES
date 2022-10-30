import { Notify } from 'quasar';

export function errorAlreadyExist(text: string) {
  return Notify.create({
    position: 'top',
    message: text + ' existe déjà',
    color: 'red',
  });
}
