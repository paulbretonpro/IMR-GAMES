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
  name: string;
  role: number;
  word: string;
}