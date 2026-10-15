(() => {
  'use strict';

  const header = document.querySelector('[data-header]');
  const menuToggle = document.querySelector('[data-menu-toggle]');
  const navigation = document.querySelector('#site-navigation');

  if (header && menuToggle && navigation) {
    header.classList.add('enhanced');
    menuToggle.hidden = false;

    const setMenuOpen = (open) => {
      header.classList.toggle('is-menu-open', open);
      menuToggle.setAttribute('aria-expanded', String(open));
      menuToggle.querySelector('[data-menu-label]').textContent = open ? 'Close' : 'Menu';
    };
    menuToggle.addEventListener('click', () => {
      setMenuOpen(menuToggle.getAttribute('aria-expanded') !== 'true');
    });
    navigation.addEventListener('click', (event) => {
      if (event.target.closest('a')) setMenuOpen(false);
    });
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && menuToggle.getAttribute('aria-expanded') === 'true') {
        setMenuOpen(false);
        menuToggle.focus();
      }
    });
    document.addEventListener('click', (event) => {
      if (!header.contains(event.target)) setMenuOpen(false);
    });
    window.matchMedia('(max-width: 620px)').addEventListener('change', () => setMenuOpen(false));
  }

  const directory = document.querySelector('[data-directory]');
  if (!directory) return;

  const search = directory.querySelector('#app-search');
  const filters = Array.from(directory.querySelectorAll('[data-filter]'));
  const items = Array.from(directory.querySelectorAll('[data-category]'));
  const resultCount = directory.querySelector('[data-results-count]');
  const emptyState = directory.querySelector('[data-empty-state]');
  const resetButton = directory.querySelector('[data-reset-filters]');
  let activeCategory = 'all';

  const filterApps = () => {
    const terms = search.value.toLocaleLowerCase().trim().split(/\s+/).filter(Boolean);
    let visibleCount = 0;
    for (const item of items) {
      const categoryMatches = activeCategory === 'all' || item.dataset.category === activeCategory;
      const content = item.dataset.search.toLocaleLowerCase();
      const searchMatches = terms.every((term) => content.includes(term));
      item.hidden = !(categoryMatches && searchMatches);
      if (!item.hidden) visibleCount += 1;
    }
    for (const filter of filters) {
      const selected = filter.dataset.filter === activeCategory;
      filter.classList.toggle('is-active', selected);
      filter.setAttribute('aria-pressed', String(selected));
    }
    resultCount.textContent = activeCategory === 'all' && terms.length === 0
      ? `${items.length} apps to explore`
      : `${visibleCount} of ${items.length} apps`;
    emptyState.hidden = visibleCount !== 0;
  };

  for (const filter of filters) {
    filter.addEventListener('click', () => {
      activeCategory = filter.dataset.filter;
      filterApps();
    });
  }
  search.addEventListener('input', filterApps);
  search.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      search.value = '';
      filterApps();
    }
  });
  resetButton.addEventListener('click', () => {
    activeCategory = 'all';
    search.value = '';
    filterApps();
    search.focus();
  });
  document.addEventListener('keydown', (event) => {
    const target = event.target;
    const editing = target instanceof Element && target.closest('input, textarea, select, [contenteditable="true"]');
    if (event.key === '/' && !event.ctrlKey && !event.metaKey && !event.altKey && !editing) {
      event.preventDefault();
      search.focus();
    }
  });

  directory.querySelector('[data-directory-controls]').hidden = false;
  filterApps();
})();
