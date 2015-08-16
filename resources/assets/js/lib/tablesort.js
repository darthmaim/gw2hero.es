import tablesort from 'tablesort';
import './tablesort.number.js'

window.Tablesort = tablesort;

export default function(selector) {
    Array.from(document.querySelectorAll(selector)).forEach( e => {
        tablesort(e);
    });
}
