const $URL_BASE = $("#url_base").val();

/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
particlesJS.load("particles-js", `${$URL_BASE}/assets/particlesjs.json   `, function () {
   // console.log("callback - particles.js config loaded");
});
