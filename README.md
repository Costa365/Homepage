# Costa365 Homepage

A PHP portfolio for Costa365's apps, games, and experiments. The site uses soft slate surfaces, bright ivory text, and warm amber accents, with a numbered app directory and matching client/server information utilities.

## Run locally

With PHP 7.4 or later:

```sh
php -S localhost:8080 -t src
```

Then visit `http://localhost:8080`. Alternatively, use the existing Apache container:

```sh
docker compose up -d
```

It serves the site on `http://localhost`. No frontend build or package installation is needed.

## Content

Edit `src/content/sites.json` to add or update an entry:

```json
{
  "name": "Your app",
  "description": "A short explanation of what the app does.",
  "link": "https://example.com",
  "image": "images/your-app.png",
  "category": "Tools"
}
```

Use `Tools`, `Discover`, or `Play` to match the current filters, or add another category. App counts, numbering, and filters are generated from the content. Entries with the category `Elsewhere` appear in the profile section and also use a `label` field.

## Interface

- Search matches app names, descriptions, and categories, and combines with the selected filter. Press `/` to focus search or Escape to clear it.
- Every app remains available when JavaScript is disabled; the mobile navigation also stays accessible.
- All external app and profile links open in a new tab.
- Responsive layouts, visible keyboard focus, live result counts, and reduced-motion support are included.
- `src/css/styles.css` contains the design tokens and layout; `src/js/site.js` handles navigation and filtering.
- `head.php`, `header.php`, `footer.php`, and `view.php` provide the shared page layout and escaped output.
- Stylesheets, scripts, and the SVG favicon use content-versioned URLs so a cached asset from an older design is not reused after an update.
- The display font is self-hosted Liberation Sans Bold. Its SIL Open Font License is included in `src/fonts/LICENSE.txt`. No external fonts or frontend libraries are requested.

The information utilities use the existing IP-API service for public network details, with a two-second HTTP timeout and graceful fallback when the service is unavailable. Private and reserved addresses are not looked up.

## Validation

```sh
php src/tests/smoke.php
phpunit --do-not-cache-result src/tests/clientInfoTest.php
node --check src/js/site.js
```

The standalone smoke checks cover page rendering, app destinations, navigation, escaped output, and unavailable network details. PHPUnit requires its standard PHP extensions, including DOM and tokenizer.
