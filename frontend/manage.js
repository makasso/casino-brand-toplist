const form = document.getElementById("brand-form");
const msg = document.getElementById("form-msg");
const table = document.getElementById("brand-table");

function loadTable() {
    fetch("http://localhost:8000/")
        .then(res => res.json())
        .then(data => {
            table.innerHTML = "";
            data.forEach(brand => {
                const row = document.createElement("tr");
                row.innerHTML = `
          <td contenteditable="true" data-id="${brand.brand_id}" data-key="brand_name">${brand.brand_name}</td>
          <td><img src="${brand.brand_image}" width="40"></td>
          <td contenteditable="true" data-id="${brand.brand_id}" data-key="rating">${brand.rating}</td>
          <td contenteditable="true" data-id="${brand.brand_id}" data-key="country_code">${brand.country_code || ""}</td>
          <td>
            <button class="btn-danger" onclick="deleteBrand(${brand.brand_id})">x</button>
          </td>
        `;
                table.appendChild(row);
            });
        });
}

function deleteBrand(id) {
    fetch(`http://localhost:8000/${id}`, { method: "DELETE" })
        .then(() => loadTable());
}

form.addEventListener("submit", (e) => {
    e.preventDefault();
    const data = {
        brand_name: form.brand_name.value,
        brand_image: form.brand_image.value,
        rating: parseInt(form.rating.value),
        country_code: form.country_code.value || null,
    };

    fetch("http://localhost:8000/", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    }).then(res => {
        if (!res.ok) return msg.textContent = "Failed to create brand.";
        msg.textContent = "Brand created.";
        form.reset();
        loadTable();
    });
});

// Inline editing
table.addEventListener("blur", e => {
    const cell = e.target;
    const id = cell.dataset.id;
    const key = cell.dataset.key;
    if (!id || !key) return;

    const newValue = cell.textContent.trim();
    fetch(`http://localhost:8000/${id}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ [key]: key === "rating" ? parseInt(newValue) : newValue })
    }).then(() => {
        loadTable();
    });
}, true);

// Init
loadTable();
