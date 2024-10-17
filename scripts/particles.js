const URL_BASE = document.getElementById("url_base").value;
console.log("en el archivo particles.js", URL_BASE);

/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
particlesJS.load("particles-js", `${URL_BASE}/assets/particlesjs.json`, function () {
   // console.log("callback - particles.js config loaded");
});
