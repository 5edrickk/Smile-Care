import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    let services = document.getElementsByClassName("service");
    for (let i = 0, l = services.length; i < l; i++) {
        services[i].addEventListener('click', (e) => { showService(e, i + 1); });
    }
});

function showService(evt, i) {
    if (evt.type == 'click') {
        let ex = document.getElementById("servicesSecrets" + i);
        if (ex.classList.contains("hidden"))
            ex.classList.remove("hidden");
        else
            ex.classList.add("hidden");
    }
}
