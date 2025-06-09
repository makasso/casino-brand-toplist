const brandList = document.getElementById("brand-list");
const countrySelect = document.getElementById("country");

const supported = ["FR", "CA", "BG", "DE", "GB", "US"];

function getCountry() {
    return localStorage.getItem("userCountry") || "FR";
}

function setCountry(code) {
    localStorage.setItem("userCountry", code);
}

function loadBrands(country) {
    fetch(`http://localhost:8000?country=${country}`)
        .then(res => res.json())
        .then(data => {
            brandList.innerHTML = "";
            data.forEach(brand => {
                const card = document.createElement("div");
                card.className = "brand-card";
                card.innerHTML = `
          <img src="${brand.brand_image}" alt="${brand.brand_name}">
          <div class="brand-info">
            <h3>${brand.brand_name}</h3>
            <p>⭐ ${brand.rating} / 5</p>
          </div>
        `;
                brandList.appendChild(card);
            });
        });
}

countrySelect.value = getCountry();
loadBrands(getCountry());

countrySelect.addEventListener("change", e => {
    setCountry(e.target.value);
    loadBrands(e.target.value);
});
