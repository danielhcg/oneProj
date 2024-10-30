function toggleDropdown(dropdownContentId, maxHeightDD) {
    var dropdownContent = document.getElementById(dropdownContentId);

    if (dropdownContent.classList.contains("expand")) {
        dropdownContent.style.maxHeight = null;
        dropdownContent.classList.remove("expand");
    } else {
        dropdownContent.style.maxHeight = maxHeightDD;
        dropdownContent.classList.add("expand");
    }
}

function toggleDropdownWide(dropdownContentId, maxHeightDD, titleboxID, dropdownButtonID, sizeIn, sizeOut) {
    var dropdownContent = document.getElementById(dropdownContentId);
    var titleBox = document.getElementById(titleboxID);
    var dropdownButton = document.getElementById(dropdownButtonID);

    if (dropdownContent.classList.contains("expand")) {
        titleBox.style.width = "350px";
        dropdownButton.style.left = sizeIn;
        dropdownContent.style.maxHeight = null;
        dropdownContent.style.maxWidth = "350px";
        dropdownContent.classList.remove("expand");
    } else {
        titleBox.style.width = "1200px";
        dropdownButton.style.left = sizeOut;
        dropdownContent.style.maxHeight = maxHeightDD;
        dropdownContent.style.maxWidth = "1200px";
        dropdownContent.classList.add("expand");
    }
}

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('dropdownButtonimg')) {
        event.target.classList.toggle('flipped');
    }
});