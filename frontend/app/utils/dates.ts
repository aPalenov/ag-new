export const formatDate = (date: string | Date): string => {
  if (!date) {
    return ''
  }

  const dateObj = typeof date === 'string' ? new Date(date) : date

  return new Intl.DateTimeFormat('ru-RU', {
    day: '2-digit',
    month: 'long',
    year: 'numeric',
  })
    .format(dateObj)
    .replace(' г.', '')
}
