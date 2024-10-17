const URL_BASE_ = document.getElementById("url_base").value;
// console.log("en el archivo particles.js", URL_BASE_);

/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
particlesJS.load("particles-js", `${URL_BASE_}/assets/particlesjs.json`, function () {
   // console.log("callback - particles.js config loaded");
});
