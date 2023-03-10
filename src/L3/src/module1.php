<?php

    //On regarde si une cession existe.
    session_start();
    //Si aucune cession existe, on renvois sur la page de connexion.
    if(!isset($_SESSION['user'])) {
       header('Location: connexion.php');
    }
 
?>

<!doctype html>
<html lang="fr">

  <script type="text/javascript">
    /*
    logiciel libre sous licence MIT
    auteur: Alain Busser
    date: 27 mai 2013
    source : https://irem.univ-reunion.fr/IMG/html/normales.html
    */

    var coef=Math.sqrt(2*Math.PI);

    function arrondi(x,e){
    	var p10=Math.pow(10,e);
    	return(Math.round(p10*x)/p10);
    }

    function arrondi_inf(x,e){
    	var p10=Math.pow(10,e);
    	return(Math.floor(p10*x)/p10);
    }

    function arrondi_sup(x,e){
    	var p10=Math.pow(10,e);
    	return(Math.ceil(p10*x)/p10);
    }


    function phi(x){
    	return Math.exp(-x*x/2)/coef;
    }

    function erf(x){
    	var t=1/(1+0.3275911*x);
    	var ye=1.061405429;
    	ye=ye*t-1.453152027;
    	ye=ye*t+1.421413741;
    	ye=ye*t-0.284496736;
    	ye=ye*t+0.254829592;
    	ye*=t;
    	ye*=Math.exp(-x*x);
    	return (1-ye);
    }

    function Pi(x){
    	if(x<0){return(1-Pi(-x));} else {
    		if(x<100){
    		return((1+erf(x/Math.SQRT2))/2);
    		} else {
    			return(1);
    		}
    	}
    }

    function maj(){
    	mu=parseFloat(document.getElementById('esp').value);
    	sigma=Math.abs(parseFloat(document.getElementById('et').value));
    	Xmin=Math.max(mu-100*sigma,parseFloat(- document.getElementById('t').value));
    	Xmax=Math.min(mu+100*sigma,parseFloat(document.getElementById('t').value));
    	a=(Xmin-mu)/sigma;
    	b=(Xmax-mu)/sigma;
    	odg=1-Math.round(Math.log(8*sigma)/Math.LN10);
    	pdec=Math.pow(10,-odg);
    	remplir2();

    }

    function remplir2(){
    	var ctx2=document.getElementById('can2');
    	if (ctx2.getContext){
    		var ctx2=ctx2.getContext('2d');
    		ctx2.fillStyle="White";
    		ctx2.fillRect(0,0,400,240);
    		ctx2.fillStyle="Lightgreen";
    		ctx2.strokeStyle="Cyan";
    		ctx2.beginPath();
    		ctx2.moveTo(0,220);

    		for(x=0;x<=Math.round(200+50*b);x++){
    			ctx2.lineTo(x,220-500*phi((x-200)/50));
    		}

    		ctx2.lineTo(200+50*b,220);
    		ctx2.lineTo(0,220);
    		ctx2.stroke();
    		ctx2.fill();
    		
    		ctx2.strokeStyle="Red";
    		ctx2.beginPath();
    		ctx2.moveTo(0,220);

    		for(x=1;x<=400;x++){
    			ctx2.lineTo(x,220-500*phi((x-200)/50));
    		}

    		ctx2.stroke();
    		ctx2.strokeStyle="Blue";
    		ctx2.fillStyle="Magenta";
    		ctx2.beginPath();

    		for(var xg=arrondi_sup(mu-4*sigma,odg);xg<arrondi_inf(mu+4*sigma,odg);xg=arrondi(xg+pdec,odg)){
    			x=(xg-mu)/sigma;
    			x=x*50+200;
    			ctx2.moveTo(x,220);
    			ctx2.lineTo(x,225);
    			ctx2.fillText(xg.toString(),x-5,235);
    		}

    		ctx2.moveTo(0,220);
    		ctx2.lineTo(400,220);
    		ctx2.stroke();
    	}
    }
  </script>


  <?php
    //On inclus le header de la page.
    require("imports_html/head.html");
  ?>
  
  <body>
		
        <?php
            //On inclus la barre de navigation.
            require("imports_html/nav_bar.html");
        ?>

        <div class="entete">
            <h1>X Calculator</h1>
            <h2>Module de probabilit??.</h2>
            <br>
            <p class="pacc_mod_pres">Vous pouvez calculer P(X < t) en saisissant la valeur de m, de ?? et t (?? 10^-5 pr??s).</p>
        </div>

        <div class='container-module-parent'>
            <form name="form_module1" action='' method='post'>
                <div class='container-module'>
                    <div class='container-form'>
                        <h2>Module de probabilit??.</h2>
                        <p>Calcul d'une probabilit?? ?? l'aide d'une loi normale</p>

                        <div class='inputs-module'>

                            <p class="titre-form-module-proba">M??thode de calcule :</p>
                            <select name="choix_methode" id="choix_methode">
                                <option  selected disabled hidden>Choisissez une m??thode</option>
                                <option value="rectangles_gauches.py">M??thode rectangles gauches</option>
                                <option value="rectangles_droites.py">M??thode rectangles droits</option>
                                <option value="rectangles_medians.py">M??thode rectangles medians</option>
                                <option value="methode_trapezes.py">M??thode Trap??zes</option>
                                <option value="methode_simpson.py">M??thode Simpson</option>
                            </select>

                            <p class="titre-form-module-proba">Valeur de ?? :</p>
                            <label id="label-esp" for="esp">
                            <input type="text" name="esp" id="esp" placeholder="ex : 1" value="<?php echo isset($_POST['esp']) ? $_POST['esp'] : '' ?>"/>

                            <p class="titre-form-module-proba">Valeur de ?? :</p>
                            <label id="label-et" for="et">
                            <input type="text" name="et" id="et" placeholder="ex : 1" value="<?php echo isset($_POST['et']) ? $_POST['et'] : '' ?>"/>

                            <p class="titre-form-module-proba">Valeur de t :</p>
                            <label id="label-t" for="t">
                            <input type="text" name="t" id ="t" placeholder="ex : 1" value="<?php echo isset($_POST['t']) ? $_POST['t'] : '' ?>"/>
                        </div>
                        <input id="input-module-send" name='submit' type="submit" value="Calculer"></input>
                    </div>
                    <div class="vertical-line"></div>
                    <div class='container-resultat'>
                        <h2>R??sultat</h2>
                        <?php

                            if(isset($_POST['submit'])){
                                if(isset($_POST['choix_methode'])){
                                    if(isset($_POST['esp'])){
                                        if(isset($_POST['et'])){
                                            if(isset($_POST['t'])){

                                                #On r??cupere les entr??es.
                                                $esp = $_POST["esp"];
                                                $et = $_POST["et"] ;
                                                $t = $_POST["t"];
                                                #On v??rifie si elle sont bien des chiffres.
                                                if (!(is_numeric($esp) && is_numeric($et) && is_numeric($t))){
                                                    //Si non on renvois une erreur.
                                                    echo "<p class='err'> Erreur : Un (ou plusieurs) param??tre n'est pas au bon format.</p>";
                                                //On v??rifie que "et" n'est pas null.
                                                } else if ($et <= 0){
                                                    //Si non on renvois une erreur.
                                                    echo "<p class='err'> La valeur de ?? ne peux pas ??tre inf??rieure ou ??gale ?? 0.</p>";
                                                //Dans le cas ou tout est bon on calcule et on affiche les resultats.
                                                } else {
                                                $fonction = $_POST["choix_methode"] ;
                                                #Pr??paration de la commande.
                                                $command = "python python_module1/$fonction $esp $et $t "; 
                                                #Execution de la commande et on r??cupere le resultat.
                                                $result = exec($command); 
                                                #On affiche le r??sultat.
                                                echo "<h1>".$result."</h1>";
                                                #On envoie le graphique.
                                                echo '<h4>Repr??sentation graphique</h4>
                                                    <canvas id="can2" width="400" height="240"></canvas>
                                                    <script type="text/javascript">maj();</script>';
                                                }

                                            }else{
                                                //Si ?? est vide, on affiche une erreur.
                                                echo "<p class='err'> Erreur : Le champ \"??\" est vide.</p>";
                                            }
                                        }else{
                                            //Si ?? est vide, on affiche une erreur.
                                            echo "<p class='err'> Erreur : Le champ \"??\" est vide.</p>";
                                        }
                                    }else{
                                        //Si t est vide, on affiche une erreur.
                                        echo "<p class='err'> Erreur : Le champ \"t\" est vide.</p>";
                                    }
                                }else{
                                    //Si la m??thode de calcule n'est pas choisis, on affiche une erreur.
                                    echo "<p class='err'> Erreur : Vous n'avez pas choisis la methode.</p>";
                                }
                            }

                        ?>
                    </div>
                </div>
            </form>
        </div>
    <?php
        //On inclus le footer de la page.
        require("imports_html/footer.html");
    ?>
</html>