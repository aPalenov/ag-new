import * as plugin from 'tailwindcss/plugin'

export type BrandColors = [
  accent: string,
  dark: string,
  light: string,
  blue: string,
  cyan: string,
  pink: string,
  lightText: string,
  text: string,
]

// prettier-ignore
export const brands: Record<string, BrandColors> = {
  baic:         ['#d3322a','#3c3c3b','#d3322a','#3c3c3b','#d3322a','#d3322a','#ffffff','#d3322a'],
  belgee:       ['#EF8100','#000000','#EF8100','#000000','#EF8100','#EF8100','#ffffff','#EF8100'],
  bestune:      ['#3366BD','#4C4948','#3366BD','#4C4948','#3366BD','#3366BD','#ffffff','#3366BD'],
  bmw:          ['#1c69d4','#4d4d4d','#cbd5dc','#1c69d4','#1c69d4','#1c69d4','#ffffff','#1c69d4'],
  changan:      ['#005bbb','#34373a','#005bbb','#005bbb','#005bbb','#005bbb','#ffffff','#005bbb'],
  chery:        ['#ca0100','#262626','#ca0100','#ca0100','#ca0100','#ca0100','#ffffff','#ca0100'],
  cheryexeed:   ['#c78e66','#30363a','#c78e66','#30363a','#c78e66','#c78e66','#333333','#c78e66'],
  chrysler:     ['#558ddd','#000000','#558ddd','#000000','#558ddd','#558ddd','#ffffff','#558ddd'],
  citroen:      ['#eb6428','#6e6e6e','#eb6428','#eb6428','#eb6428','#eb6428','#ffffff','#eb6428'],
  daewoo:       ['#005bbb','#34373a','#005bbb','#005bbb','#005bbb','#005bbb','#ffffff','#005bbb'],
  dongfeng:     ['#e60020','#000000','#e60020','#000000','#e60020','#e60020','#ffffff','#e60020'],
  ds:           ['#2f2726','#2f2726','#ad0040','#2f2726','#2f2726','#ad0040','#ffffff','#2f2726'],
  faw:          ['#ff0000','#18203d','#ff0000','#18203d','#ff0000','#ff0000','#ffffff','#ff0000'],
  geely:        ['#0067b2','#303c48','#cbd5dc','#0067b2','#0067b2','#0067b2','#ffffff','#0067b2'],
  genesis:      ['#a36b4f','#000000','#a36b4f','#000000','#a36b4f','#a36b4f','#333333','#a36b4f'],
  'gm-avtovaz': ['#ff820f','#495966','#ff820f','#495966','#ff820f','#ff820f','#ffffff','#ff820f'],
  'great-wall': ['#2f2726','#2f2726','#ad0040','#2f2726','#2f2726','#ad0040','#ffffff','#2f2726'],
  hower:        ['#2f2726','#2f2726','#ad0040','#2f2726','#2f2726','#ad0040','#ffffff','#2f2726'],
  hyundai:      ['#e63312','#103a71','#33c8ea','#103a71','#103a71','#e63312','#ffffff','#e63312'],
  jac:          ['#c02127','#3c3c3b','#c02127','#3c3c3b','#c02127','#c02127','#ffffff','#c02127'],
  jeep:         ['#ffba00','#000000','#ffba00','#000000','#ffba00','#ffba00','#333333','#f7761f'],
  jetour:       ['#5cacb1','#000000','#cbd5dc','#5cacb1','#5cacb1','#5cacb1','#ffffff','#5cacb1'],
  jetta:        ['#2a59fe','#34373a','#2a59fe','#2a59fe','#2a59fe','#2a59fe','#ffffff','#2a59fe'],
  kaiyi:        ['#000000','#000000','#000000','#000000','#000000','#000000','#ffffff','#000000'],
  kia:          ['#05141f','#05141f','#05141f','#05141f','#05141f','#05141f','#ffffff','#05141f'],
  knewstar:     ['#0b0d0c','#0b0d0c','#0b0d0c','#0b0d0c','#0b0d0c','#0b0d0c','#ffffff','#0b0d0c'],
  kgm:          ['#2f2c4d','#4d4d4d','#2f2c4d','#2f2c4d','#2f2c4d','#2f2c4d','#ffffff','#2f2c4d'],
  lada:         ['#ff820f','#495966','#ff820f','#495966','#ff820f','#ff820f','#ffffff','#ff820f'],
  lifan:        ['#005bbb','#34373a','#005bbb','#005bbb','#005bbb','#005bbb','#ffffff','#005bbb'],
  mazda:        ['#191919','#191919','#191919','#191919','#191919','#191919','#ffffff','#191919'],
  mercedes_benz:['#0178D6','#000000','#cbd5dc','#0178D6','#0178D6','#0178D6','#ffffff','#0178D6'],
  mitsubishi:   ['#f32317','#000000','#f32317','#000000','#f32317','#f32317','#ffffff','#f32317'],
  moskvich:     ['#d6001c','#000000','#d6001c','#000000','#d6001c','#d6001c','#ffffff','#d6001c'],
  peugeot:      ['#4cc9f9','#3c3947','#4cc9f9','#333333','#4cc9f9','#4cc9f9','#333333','#4cc9f9'],
  ravon:        ['#005bbb','#34373a','#005bbb','#005bbb','#005bbb','#005bbb','#ffffff','#005bbb'],
  renault:      ['#ffcc33','#000000','#ffcc33','#000000','#ffcc33','#ffcc33','#333333','#f7761f'],
  solaris:      ['#f0cfa2','#1b365d','#33c8ea','#1b365d','#1b365d','#f0cfa2','#333333','#f0cfa2'],
  soueast:      ['#fe7600','#000000','#fe7600','#000000','#fe7600','#fe7600','#ffffff','#fe7600'],
  ssangyong:    ['#ff0000','#060d3c','#ff0000','#060d3c','#ff0000','#ff0000','#ffffff','#ff0000'],
  suzuki:       ['#e30613','#022b4a','#e30613','#022b4a','#e30613','#e30613','#ffffff','#e30613'],
  swm:          ['#e62336','#646363','#e62336','#646363','#e62336','#e62336','#ffffff','#e62336'],
  tenet:        ['#c30d23','#3e3a39','#3e3a39','#3e3a39','#3e3a39','#3e3a39','#ffffff','#3e3a39'],
  toyota:       ['#ff0022','#282830','#ff0022','#282830','#ff0022','#ff0022','#ffffff','#ff0022'],
  uaz:          ['#ed1c24','#1c252c','#014637','#014637','#014637','#ed1c24','#ffffff','#ed1c24'],
  volkswagen:   ['#2dade4','#001e50','#33c8ea','#001e50','#001e50','#2dade4','#ffffff','#2dade4'],
  xcite:        ['#f7a92f','#000000','#f7a92f','#000000','#f7a92f','#f7a92f','#ffffff','#f7a92f'],
}

// Plugin: generate brand classes that set CSS variables
export const brandVariables = plugin.default(({ addBase }) => {
  const rules: Record<string, Record<string, string>> = {}
  for (const mark in brands) {
    rules[`.${mark}`] = {
      '--brand-color-accent': brands[mark][0],
      '--brand-color-dark': brands[mark][1],
      '--brand-color-light': brands[mark][2],
      '--brand-color-blue-color': brands[mark][3],
      '--brand-color-cyan-color': brands[mark][4],
      '--brand-color-pink-color': brands[mark][5],
      '--brand-color-light-text': brands[mark][6],
      '--brand-color-text': brands[mark][7],
    }
  }
  addBase(rules)
})

export default brandVariables
