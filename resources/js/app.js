import './bootstrap';
import './dark';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// // Admin Tour via Intro.js
// window.startAdminTour = () => {
//     introJs().setOptions({
//         showProgress: true,
//         nextLabel: 'Next →',
//         prevLabel: '← Back',
//         doneLabel: 'Finish',
//         skipLabel: 'Skip Tour',
//     }).start();
// };

