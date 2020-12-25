function regular_map() {
    var var_location = new google.maps.LatLng(48.864716, 2.349014);

    var var_mapoptions = {
      center: var_location,
      zoom: 14
    };

    var var_map = new google.maps.Map(document.getElementById("map-container"),
      var_mapoptions);

    var var_marker = new google.maps.Marker({
      position: var_location,
      map: var_map,
      title: "Paris"
    });
}

// Initialize maps
google.maps.event.addDomListener(window, 'load', regular_map);

function like(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "like.php?id=" + id, false);
    xmlhttp.send(null);

    if (xmlhttp.responseText === '1') {
        if ($("#like_" + id).hasClass("fa-heart-o")) {
            $("#like_" + id).removeClass("fa-heart-o");
            $("#like_" + id).addClass("fa-heart");
        }
    } else {
        if ($("#like_" + id).hasClass("fa-heart")) {
            $("#like_" + id).removeClass("fa-heart");
            $("#like_" + id).addClass("fa-heart-o");
        }
    }
}

function like_bag(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "like.php?id=" + id, false);
    xmlhttp.send(null);

    if (xmlhttp.responseText === '1') {
        $("#like_button").html("Удалить из избранных");
    } else {
        $("#like_button").html("В избранное");
    }
}
