<?php 
const KEYWORD_LIST = "add, read, exit\n";
function ui() {
    echo "Mit szeretne tenni?\n(írja be a \"help\" szót a kulcsszavak megtekintéséhez.)\n";
    $valasz1 = readline("");
    actionSwitch($valasz1);
}
//Minden
function actionSwitch($keyword) {
    switch ($keyword) {
        case 'help': echo KEYWORD_LIST; break;
        case 'add': dialogueAdd(); break;
        case 'read': dialogueRead(); break;
        case 'exit':
            echo "Rendben, minden jót";
            global $program; $program = false; break;
    }
}
//Add
function dialogueAdd() {
    echo "Mi a kiadás dátuma? (pl. 2018 8 25 (szóközzel, pont nélkül)\n";
    $datum = readline('');
    echo "Mi a kiadás összege? (forintban, \"Ft\" nélkül)";
    $osszeg = readline('');
    echo "Mire ment a kiadás?";
    $megjegyzes = readline('');
    actionAdd($datum, $osszeg, $megjegyzes);
}
function actionAdd (string $dat, string $ossz, string $megj) {
    $datumTomb = explode(' ', $dat);
    $file = fopen("kiadasok.txt", "a");
    fwrite($file, "{$datumTomb[0]};{$datumTomb[1]};{$datumTomb[2]};{$ossz};{$megj}\n");
    fclose($file);
    echo "{$datumTomb[0]};{$datumTomb[1]};{$datumTomb[2]};{$ossz};{$megj}\n";
}
//Read
function dialogueRead() {
    echo "Kiadások áttekintése\nkiadás éve:\n";
    $readEv = readline('');
    echo "Kiadás hónapja (*→összes):\n";
    $readHo = readline('');
    if ($readHo == "*") actionRead($readEv, "0", "0");
    else {
        echo "Kiadás napja (*→összes):\n";
        $readNap = readline('');
        if ($readNap == "*") actionRead($readEv, $readHo, "0");
        else actionRead($readEv, $readHo, $readNap);
    }
}
function actionRead($ev, $ho="0", $nap="0") {
    $file = fopen("kiadasok.txt", "r");
    while (!feof($file)) {
        $line = fgets($file);
        $lineArray = explode(";", $line);
        //echo $lineArray[2] . " " . $lineArray[1] . " " . $lineArray[0];
        if ($nap=="0" && $ho=="0" && $lineArray[0] == $ev) echo $line;
        else if ($nap=="0" && $lineArray[1]==$ho && $lineArray[0] == $ev) echo $line;
        else if ($lineArray[2]==$nap && $lineArray[1]==$ho && $lineArray[0] == $ev) echo $line;
    }
    fclose($file);
}
?>