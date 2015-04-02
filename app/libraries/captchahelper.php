<?php

function get_challenge()
{
  Session::forget('challenge');
  $challengeOp1 = rand(7,15);
  $challengeOp2 = rand(7,15);
  Session::put('challenge', $challengeOp1 + $challengeOp2); 
  return sprintf("%s + %s", $challengeOp1, $challengeOp2);
}

