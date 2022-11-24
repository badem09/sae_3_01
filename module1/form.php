<?php?>

<form name="form_module1" action="actionform.php" method="post">

    <select name="choix_methode" id="choix_methode">
        <option value="rectangles_gauches.py">Rectangles gauches</option>
        <option value="rectangles_droites.py">Rectangles droits</option>
        <option value="rectangles_medians.py">Rectangles medians</option>
        <option value="methode_trapezes.py">Trapèzes</option>
        <option value="methode_simpson.py">Simpson</option>

    </select>
    <p>
        Valeur µ :<br />
        <input type="text" name="esp" value="yes" />
    </p>
    <p>
        Valeur de σ :<br />
        <input type="text" name="et" value="yes"  />
    </p>
    <p>
        valeur de t :<br />
        <input type="text" name="t" value="yes"  />
    </p>
    <p>
        <input type="submit" value="Calculer P( X ≤ a ) " />
        <input type="reset" value="Annuler" />
    </p>
</form>
