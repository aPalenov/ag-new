# Nuxt Minimal Starter

Look at the [Nuxt documentation](https://nuxt.com/docs/getting-started/introduction) to learn more.

## Multi-tenant demo pages (wired to Laravel API)

This frontend calls the backend Laravel API at `/api/pages{path}` and renders block-based pages. The backend detects tenant by the HTTP Host header.

Example tenants and pages:

- http://ag-new.loc/ → Home (main tenant)
- http://ag-new.loc/about → About (main tenant)
- http://kia.ag-new.loc/ → Home (KIA)
- http://kia.ag-new.loc/service → Service (KIA)
- http://lada.ag-new.loc/ → Home (LADA)
- http://lada.ag-new.loc/models → Models (LADA)

The renderer lives in `app/components/PageBuilder.vue` and renders blocks by name (HeroBanner, FeatureList, TextBlock, ServiceGrid). Fetching is implemented in `app/composables/usePageData.ts`. The catch-all page is `pages/[...slug].vue`.

## Setup

Make sure to install dependencies:

```bash
# npm
npm install

# pnpm
pnpm install

# yarn
yarn install

# bun
bun install
```

## Development Server

Start the development server on `http://localhost:3000`:

```bash
# npm
npm run dev

# pnpm
pnpm dev

# yarn
yarn dev

# bun
bun run dev
```

## Production

Build the application for production:

```bash
# npm
npm run build

# pnpm
pnpm build

# yarn
yarn build

# bun
bun run build
```

Locally preview production build:

```bash
# npm
npm run preview

# pnpm
pnpm preview

# yarn
yarn preview

# bun
bun run preview
```

Check out the [deployment documentation](https://nuxt.com/docs/getting-started/deployment) for more information.
