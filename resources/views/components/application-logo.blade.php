<svg viewBox="0 0 600 150" xmlns="http://www.w3.org/2000/svg" width="600" height="300">
    <defs>
        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#ffcc00;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#ff6600;stop-opacity:1" />
        </linearGradient>
    </defs>
    <path d="M300,15 L375,40 L375,105 L300,135 L225,105 L225,40 Z" fill="url(#grad1)" stroke="#ff6600" stroke-width="3" rx="15" />
    <text x="50%" y="50%" font-family="Arial, sans-serif" font-size="36" fill="#ffffff" text-anchor="middle" alignment-baseline="middle" font-weight="bold" filter="url(#text-shadow)">
        UniversAuto
    </text>
    <filter id="text-shadow" x="-20%" y="-20%" width="140%" height="140%">
        <feGaussianBlur in="SourceAlpha" stdDeviation="4" />
        <feOffset dx="3" dy="3" result="offsetblur" />
        <feFlood flood-color="rgba(0,0,0,0.5)" />
        <feComposite in2="offsetblur" operator="in" />
        <feMerge>
            <feMergeNode />
            <feMergeNode in="SourceGraphic" />
        </feMerge>
    </filter>
</svg>
