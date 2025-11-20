interface DeclensionTitles extends Array<string> {
  0: string
  1: string
  2: string
  length: 3
}

export function declensionByNumber(n: number, titles: DeclensionTitles): string {
  return titles[
    n % 10 == 1 && n % 100 != 11
      ? 0
      : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20)
        ? 1
        : 2
  ]
}
