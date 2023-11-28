<?php
include 'ui.php';
static $program = true;
//program
echo "Üdvözöljük. ";
while ($program == true) {
    ui();
}
//vége
function isExit() {
    echo "Szeretnél kilépni? (y/n)\n";
    $valaszExit = readline('');
    if (valaszExit == "y") { 
        echo "Renden, minden jót";
        global $program; $program = false;
    }
}




?>