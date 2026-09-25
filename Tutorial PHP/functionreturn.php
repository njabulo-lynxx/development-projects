<?php

  //This function is used to add variable $x and $y
  function add($x,$y)
  {
	  return $x + $y;
  }

  //This function is used to subtract variable $x and $y
  function subtract($x, $y)
  {
	  return $x - $y;
  }

  //This function is used to multiply variable $x and $y
  function multiply($x, $y)
  {
	  return $x * $y;
  }

  //This function is used to divide variable $x and $y
  function divide($x, $y)
  {
	  return $x / $y;
  }

  //Output
  echo "Addition function : " . add(90, 10) . "<br>";
  echo "Subtract function : " . subtract(79, 50) . "<br>";
  echo "Multiply function : " . multiply(5, 3) . "<br>";
  echo "Divide function : " . divide(30, 10);
?>