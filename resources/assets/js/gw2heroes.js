import {log} from "./lib/helper.js";
import tablesort from './lib/tablesort.js';

log('Welcome!');

document.addEventListener('DOMContentLoaded', function(){
    tablesort('.table--sortable');
}, false);
