export interface Words {
  good: string;
  fake: string;
}

export interface Undercover {
  id: number;
  members: Members[];
  words: Words;
}

export interface Members {
  id: number;
  name: string;
  role: string | number;
  word: string;
}
