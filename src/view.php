<?php
/** Small shared presentation helpers. */
function escape($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Give changed assets a new URL, including when the browser cached the old design. */
function assetUrl(string $path): string {
    return $path . '?v=' . substr(hash_file('sha256', __DIR__ . '/' . $path), 0, 12);
}

function icon(string $name): string {
    $paths = [
        'external' => '<path d="M6 18 18 6M6 6h12v12"/>',
        'down' => '<path d="M12 4v16m-6-6 6 6 6-6"/>',
        'up' => '<path d="M12 20V4m-6 6 6-6 6 6"/>',
        'right' => '<path d="M4 12h16m-6-6 6 6-6 6"/>',
        'search' => '<circle cx="10.5" cy="10.5" r="6.5"/><path d="m16 16 4 4"/>',
        'monitor' => '<rect x="3" y="4" width="18" height="13" rx="1"/><path d="M8 21h8m-4-4v4"/>',
        'server' => '<rect x="3" y="3" width="18" height="7" rx="1"/><rect x="3" y="14" width="18" height="7" rx="1"/><path d="M7 6.5h.01M7 17.5h.01M12 6.5h5M12 17.5h5"/>',
    ];
    return '<svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ($paths[$name] ?? $paths['external']) . '</svg>';
}

function informationValue($value): string {
    return $value !== '' && $value !== null ? escape($value) : '<span class="unavailable">Unavailable</span>';
}
