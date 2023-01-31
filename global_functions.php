<?php

function dumpopt($opt) {
  $res = [];
  foreach ($opt as $key => $value) {
    $res[] = "$key=$value";
  }
  return "[".implode(",",$res)."]";
}

function dumpdata($data,$maxlen=9) {
  $len = sizeof($data);
  $res = [];
  if ($maxlen > 0 && $len < $maxlen) {
    foreach ($data as $datum) {
      $res[] = "[${datum[0]},${datum[1]}]";
    }
    return "[".implode(",",$res)."]";
  }
  $first = $data[0];
  $last  = $data[$len-1];
  return "$len:[${first[0]},${first[1]}]..[${last[0]},${last[1]}]";
}
