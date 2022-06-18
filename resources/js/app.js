import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'
import Datepicker from 'vanillajs-datepicker/Datepicker';

Alpine.plugin(focus);
window.Alpine = Alpine;
window.Datepicker = Datepicker;
Alpine.start();
