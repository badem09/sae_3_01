<?php?>

<form name="form_module1" action="actionform.php" method="post">

    <select name="choix_methode" id="choix_methode">
        <option value="rect_g">Rectangles gauches</option>
        <option value="rect_d">Rectangles droits</option>
        <option value="rect_m">Rectangles medians</option>
        <option value="trap">Trapèzes</option>
        <option value="simp">Simpson</option>

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
        valeur de b :<br />
        <input type="text" name="t" value="yes"  />
    </p>
    <p>
        <input type="submit" value="Calculer P( X ≤ a ) " />
        <input type="reset" value="Annuler" />
    </p>
</form>
