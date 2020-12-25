<?php

function check_for_like($id) {
    if ($_COOKIE['l_'.$id]) {
        return true;
    } else {
        return false;
    }
}

?>
