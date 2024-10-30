document.querySelectorAll(".sidebar-button").forEach(function(button) {
    button.onclick = function() {
        document.body.classList.toggle("open-sidebar");
    };
});

function toggleDropdown(dropboxNum, dropdownContentNum) {
    var dropdownContent = document.getElementById(dropdownContentNum);
    var sidebarButton = document.getElementById('sidebar-button');

    if (dropdownContent.classList.contains("expand")) {
        dropdownContent.classList.remove("expand");
        dropdownContent.style.maxHeight = null;
        sidebarButton.classList.remove("expand");
        document.documentElement.style.setProperty('--matched-height', (sidebarButton.clientHeight - dropdownContent.scrollHeight) + "px");
    } else {
        dropdownContent.classList.add("expand");
        dropdownContent.style.maxHeight = dropdownContent.scrollHeight + "px";
        sidebarButton.classList.add("expand");
        document.documentElement.style.setProperty('--matched-height', (sidebarButton.clientHeight + dropdownContent.scrollHeight) + "px");
    }

}

document.addEventListener('DOMContentLoaded', () => {
    for (let i = 1; i <= 9; i++) {
        const checkbox = document.getElementById(`main-checkbox${i}`);
        const dropdown = document.getElementById(`dropdown${i}`);
        var dropdownContent = document.getElementById('dropdown-content7');

        checkbox.addEventListener('change', () => {
            dropdown.style.display = checkbox.checked ? 'block' : 'none';
            if (checkbox.checked) {
                dropdown.classList.add('expand');
                dropdown.style.maxHeight = null;
                dropdownContent.style.maxHeight = (dropdownContent.scrollHeight + dropdown.scrollHeight) + "px";
            } else {
                dropdown.querySelectorAll('input[type="checkbox"]').forEach((cb) => {
                    cb.checked = false;
                });

                // Apply changes
                dropdown.classList.remove('expand');
                dropdown.style.maxHeight = 0;
                dropdownContent.style.maxHeight = (dropdownContent.scrollHeight - dropdown.scrollHeight) + "px";

                // Defer the updateFilters call
                setTimeout(() => {
                    updateFilters();
                }, 50); // A small delay to allow the DOM to fully update
            }
            
        });
    }
});

function collectCheckboxValues(name) {
    var checkboxes = document.querySelectorAll('input[name="' + name + '"]:checked');
    var values = [];
    checkboxes.forEach((checkbox) => {
        values.push(checkbox.value);
    });
    return values;
}

function updateFilters() {

    var filterValues = collectCheckboxValues("filters[]");
    var selectValues = collectCheckboxValues("select[]");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);  // Update the URL as needed
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {  // Request is complete
            if (xhr.status == 200) {  // Request was successful
                document.getElementById("selected-filters").innerHTML = xhr.responseText;
            } else {
                console.error("Request failed. Status: " + xhr.status);
            }
        }
    };

    var data = "ajax=1";
    data += filterValues.map(value => "&filters[]=" + encodeURIComponent(value)).join("");
    data += selectValues.map(value => "&select[]=" + encodeURIComponent(value)).join("");

    xhr.send(data);
}

// Debounce function
function debounce(func, delay) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

// Function to handle checkbox changes
function onFilterChange() {
    const page = 1; // Reset to page 1
    loadPage(page); // Trigger the AJAX request to load the first page with the current filters
}

// Attach debounced event listeners to all filter checkboxes
document.querySelectorAll('input[name="filters[]"]').forEach(checkbox => {
    checkbox.addEventListener('change', debounce(onFilterChange, 300)); // 300ms debounce delay
});

document.addEventListener('DOMContentLoaded', function() {
    function loadPage(page) {
        const xhr = new XMLHttpRequest();
        const formData = new FormData();
    
        formData.append('ajax', 1);
        formData.append('page', page);
    
        var filters = collectCheckboxValues('filters[]');
        var select = collectCheckboxValues('select[]');
    
        filters.forEach(value => formData.append('filters[]', value));
        select.forEach(value => formData.append('select[]', value));
    
        xhr.open('POST', '', true);
        xhr.onload = function() {
            if (xhr.readyState == 4 && xhr.status === 200) {
                document.getElementById('selected-filters').innerHTML = xhr.responseText;
            } else {
                console.error("Request failed. Status: " + xhr.status);
            }
        };
        xhr.send(formData);
    }

    window.loadPage = loadPage; // Expose the function globally
});

//document.querySelectorAll('input[name="filters[]"], input[name="select[]"]').forEach((checkbox) => {
    //checkbox.addEventListener('change', updateFilters);
//});

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('FilterArrow')) {
        event.target.classList.toggle('flipped');
    }
});
