document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("lookup").addEventListener("click", function () {
        var countryName = document.getElementById("country").value;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById("result").innerHTML = xhr.responseText;
                } else {
                    console.error("Error fetching data: ", xhr.statusText);
                }
            }
        };

        var url = "world.php?country=" + encodeURIComponent(countryName);
        xhr.open("GET", url, true);
        xhr.send();
    });
});
