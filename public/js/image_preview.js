//prendo gli elementi e do un html di default
let imageElement = document.querySelector(".upload-image");
let imagePreview = document.querySelector(".image-preview");
let hasImage = document.querySelector(".has-image");
hasImage.innerHTML = "No Image Selected";
imagePreview.innerHTML = '<i class="fa-solid fa-x"></i>';

//funzione al change del valore del type input
imageElement.addEventListener("change", function () {
    const file = this.files[0]; // seleziono il file caricato
    //se il file esiste
    if (file) {
        const reader = new FileReader(); // Crea un oggetto FileReader

        // evento onload chiamato quando il file viene letto
        reader.onload = function (event) {
            // trasformo la path in un url
            const imageUrl = event.target.result;
            //mostro immagine
            imagePreview.innerHTML = `<img class="image rounded-2" src="${imageUrl}" alt="Anteprima dell'immagine">`;
        };

        // Legge il file come URL di dati
        reader.readAsDataURL(file);

        //cambio html e style in modo da vedere la preview e non il placeholder
        hasImage.innerHTML = "Image Preview";
        imagePreview.classList.remove(
            "image-placeholder",
            "align-items-center",
            "bg-danger",
            "rounded-2"
        );
        imagePreview.classList.add("overflow-hidden", "image-show");
    } else {
        //cambio html e style in modo da vedere il placeholder e non la preview
        hasImage.innerHTML = "No Image Selected";
        imagePreview.innerHTML = '<i class="fa-solid fa-x"></i>';
        imagePreview.classList.remove("overflow-hidden", "image-show");
        imagePreview.classList.add(
            "image-placeholder",
            "align-items-center",
            "bg-danger",
            "rounded-2"
        );
    }
});
