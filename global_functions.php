<?php

function dumpopt($opt) {
    $res = [];
    foreach ($opt as $key => $value) {
        $res[] = "$key=$value";
    }
    return "[".implode(",",$res)."]";
}

function dumpdata($data,$maxlen=900) {

    if (is_null($data)) return "null";
    if (is_string($data)) return "'$data'";

    $len = sizeof($data);
    $res = [];
    if ($maxlen > 0 && $len < $maxlen) {
        foreach ($data as $key => $datum) {
            if (is_array($datum))
                $res[] = dumpopt($datum);
            else
                $res[] = "[$key][$datum]";
        }
        return "[".implode(",",$res)."]";
    } else {
        return "too big!";
        $first = $data[0];
        $last  = $data[$len-1];
        return "$len:[${first[0]},${first[1]}]..[${last[0]},${last[1]}]";
    }
}
