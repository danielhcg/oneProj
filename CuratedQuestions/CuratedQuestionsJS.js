function toggleDropdown(dropdownContentId, sizeOut) {
    var dropdownContent = document.getElementById(dropdownContentId);

    if (dropdownContent.classList.contains("expand")) {
        dropdownContent.style.maxHeight = null;
        dropdownContent.classList.remove("expand");
    } else {
        dropdownContent.style.maxHeight = sizeOut;
        dropdownContent.classList.add("expand");
    }
}

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('dropdownButtonimg')) {
        event.target.classList.toggle('flipped');
    }
});