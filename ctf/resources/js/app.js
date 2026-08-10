import '../css/app.css';

import Alpine from 'alpinejs';
import painel from './components/painel';

window.Alpine = Alpine;

Alpine.data('painel', painel);

Alpine.start();
