function create_key($pattern = null){
    $pattern = str_replace(" ",'',$pattern);
    if ($pattern == null || empty($pattern))
    {
        return join('-', str_split(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 16), 4)); }


// info
//     1 integer
//     2 alphabet lower
//     3 alphaber upper
//     4 alphabet random
//- or 5 dash "-"
//  other than that go straight example
//
// pattern = "111222333444555" =>
//           "283htgUIXKhc---"
//           "326rngQVChVa---"
//
// pattern = "Tester4444-111"
//            TesterDMWf-614
//            TesterEayv-811


//parsing and generating
//i tryed for loop but its keeps breaking my code :(
//i wrote parser because i didnt find custom one
$x = 0;$key = "";
$pattern =(string)$pattern;
while ($x < strlen($pattern)){
    $alphabet = "abcdefghijklmnopqrstuvwxyz";
    switch ($pattern[$x]) {
        case '1':
            $key .=  random_int(0,9);
            break;
        case '2':
            $key .=  $alphabet[random_int(0,25)];
            break;
        case '3':
            $key .=  strtoupper($alphabet[random_int(0,25)]);
            break;
        case '4':
            if(random_int(0,1)==1){
                $key .=  $alphabet[random_int(0,25)];
            }else {
                $key .= strtoupper($alphabet[random_int(0,25)]);
            }
            break;
        case '5':
            $key .= "-";//29
            break;

    }
    $x=$x+1;
}
return $key;
}
