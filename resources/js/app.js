import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'
import Datepicker from 'vanillajs-datepicker/Datepicker';
import datepickerDeadline from "./components/datepicker-deadline";

Alpine.data('datepickerDeadline', datepickerDeadline);

window.formatDate = function (inputDate) {
    let date, month, year;

    date = inputDate.getDate();
    month = inputDate.getMonth() + 1;
    year = inputDate.getFullYear();

    date = date
        .toString()
        .padStart(2, '0');

    month = month
        .toString()
        .padStart(2, '0');

    return `${date}.${month}.${year}`;
}
Alpine.plugin(focus);
window.Alpine = Alpine;
window.Datepicker = Datepicker;
Alpine.start();

