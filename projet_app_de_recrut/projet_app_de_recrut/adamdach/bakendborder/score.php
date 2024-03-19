<?php
function score($f, $r, $s, $l, $p){
    $v = 0;

    if ($p >= 0 && $p <= 2) {
        $v += 0.5;
    } elseif ($p >= 3 && $p <= 5) {
        $v += 1;
    } else {
        $v += 2;
    }

    if (($s + 1) >= 0 && ($s + 1) <= 2) {
        $v += 1;
    } elseif (($s + 1) >= 3 && ($s + 1) <= 5) {
        $v += 2;
    } else {
        $v += 3;
    }

    if ($f >= 1 && $f <= 5) {
        $v += 0.5;
    } elseif ($f >= 6 && $f <= 10) {
        $v += 0.75;
    } else {
        $v += 1;
    }

    if ($r >= 2 && $r <= 3) {
        $v += 1;
    } elseif ($r >= 4 && $r <= 9) {
        $v += 2;
    } else {
        $v +=3;
    }

    if ($l == 2) {
        $v += 0.5;
    } elseif ($l >= 3 && $l <= 4) {
        $v += 0.75;
    } else {
        $v += 1;
    }

    return $v*10;
}
?>
