export interface Game {
  name: string;
  rule: string;
  roles: Roles[];
  code: string;
}

export interface Roles {
  name: string;
  description: string;
}

export interface Members {
  name: string;
}
