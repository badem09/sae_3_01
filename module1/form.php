<form name="form_module1" action="" method="post">

    <select name="choix_methode" id="choix_methode">
        <option value="rectangles_gauches.py">Rectangles gauches</option>
        <option value="rectangles_droites.py">Rectangles droits</option>
        <option value="rectangles_medians.py">Rectangles medians</option>
        <option value="methode_trapezes.py">Trapèzes</option>
        <option value="methode_simpson.py">Simpson</option>

    </select>
    <p>
        Valeur µ :<br />
        <input type="text" name="esp" value="" />
    </p>
    <p>
        Valeur de σ :<br />
        <input type="text" name="et" value=""  />
    </p>
    <p>
        valeur de t :<br />
        <input type="text" name="t" value=""  />
    </p>
    <p>
        <input type="submit" value="Calculer P( X ≤ a ) " />
        <input type="reset" value="Annuler" />
    </p>
</form>



<?php

if (isset($_POST['esp'], $_POST['et'], $_POST['t'])){
    $esp = $_POST["esp"];
    $et = $_POST["et"] ;
    $t = $_POST["t"];
    $fonction = $_POST["choix_methode"] ;



    $command = 'python'. ' ' . $fonction . ' '
        . $esp . ' ' . $et . ' ' .$t . ' ' ;
    echo $command . ' ';
    $result = shell_exec($command);

    echo $result;
}
?>



