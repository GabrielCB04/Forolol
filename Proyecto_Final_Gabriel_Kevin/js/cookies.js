// Si acepta las cookies se guardan un año
function AceptarCookies() {
    document.cookie = "cookies_forolol=true; max-age=" + (365 * 24 * 60 * 60) + "; path=/";
    document.getElementById("mensaje_cookies").style.display = "none";
    location.reload();
}
// Si las rechaza un año también
function RechazarCookies() {
    document.cookie = "cookies_forolol=false; max-age=" + (365 * 24 * 60 * 60) + "; path=/";
    document.getElementById("mensaje_cookies").style.display = "none";
    location.reload();
}
