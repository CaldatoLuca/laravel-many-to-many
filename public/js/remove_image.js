let removeImage = document.querySelector(".remove-image");

removeImage.addEventListener("click", function () {
    hasImage.innerHTML = "No Image Selected";
    imagePreview.innerHTML = '<i class="fa-solid fa-x"></i>';
    imagePreview.classList.remove("overflow-hidden", "image-show");
    imagePreview.classList.add(
        "image-placeholder",
        "align-items-center",
        "bg-danger",
        "rounded-2"
    );
    imageElement.value = null;
});
