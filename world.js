document.addEventListener("DOMContentLoaded", function () {
    // Attach a click event listener to the 'Lookup' button
    document.getElementById("lookup").addEventListener("click", function () {
        // Get the country name entered by the user
        var countryName = document.getElementById("country").value;

        // Perform an AJAX request to world.php with the country parameter
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Directly append the HTML to the result div
                    document.getElementById("result").innerHTML = xhr.responseText;
                } else {
                    // Handle the error
                    console.error("Error fetching data: ", xhr.statusText);
                }
            }
        };

        // Construct the URL with the country parameter
        var url = "world.php?country=" + encodeURIComponent(countryName);
        xhr.open("GET", url, true);
        xhr.send();
    });
});
