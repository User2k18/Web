<?php


$open = fopen("./100+ Python challenging programming exercises.txt",'r');

$file = fread($open,filesize("./100+ Python challenging programming exercises.txt"));

$result = sscanf($file,'Question [ -~] Level: [ -~]',$question,$lvl);

fclose($open);

if(isset($result)){
echo $result;
}


"
#----------------------------------------#
Question 1
Level 1

Question:
Write a program which will find all such numbers which are divisible by 7 but are not a multiple of 5,
between 2000 and 3200 (both included).
The numbers obtained should be printed in a comma-separated sequence on a single line.

Hints:
Consider use range(#begin, #end) method";