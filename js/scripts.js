/*!
 * Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
 */
// This file is intentionally blank
// Use this file to add JavaScript to your project

const sortSelect = document.getElementById("sortselect");
if (sortSelect) {
  sortSelect.addEventListener("change", function () {
    // this value innehåller ju <sort>-<order>
    //sort=title
    //order=asc
    const [sort, order] = this.value.split("-");
    // bygg url
    //window.location.search- är current url query string.
    const urlsearchparams = new URLSearchParams(window.location.search);
    urlsearchparams.set("sort", sort);
    urlsearchparams.set("order", order);

    // alert("selected value: " + this.value);
    // alert("selected value: " + sort + "" + order);

     window.location.search = urlsearchparams.toString();
  });
}
