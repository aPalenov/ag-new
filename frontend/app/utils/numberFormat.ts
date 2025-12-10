export function numberFormat(number: number): string {
  return new Intl.NumberFormat('ru-RU', {}).format(number)
}
