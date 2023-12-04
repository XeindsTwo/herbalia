import {setupSearchFromSearchJS} from "./search-products.js";

const form = document.querySelector('.admin-products__search');
const endpoint = form.dataset.searchUrl;
const inputSelector = '.admin-products__search input[name="query"]';
const resultContainerSelector = '.admin-products__list';

setupSearchFromSearchJS(inputSelector, resultContainerSelector, endpoint);