package com.example.app_sae_2;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_accueil);
    }

    //fonction pour aller page d'accueil
    public void openPageAccueil(View view) {
        setContentView(R.layout.layout_accueil);
    }

    //fonction pour aller page de présentation probabilité
    public void openPagePresModProba(View view) {
        setContentView(R.layout.layout_pres_proba);
    }

    //fonction pour aller page de présentation crypto
    public void openPagePresModCrypto(View view) {
        setContentView(R.layout.layout_pres_mod_crypto);
    }

    public void openPageConnexion(View view){
        setContentView(R.layout.layout_connexion);
    }

    public void openPageChoixModule(View view){
        setContentView(R.layout.layout_choix_modules);
    }

    public void openPageModCrypto(View view){
        setContentView(R.layout.layout_mod_crypto_cr4);
    }

    public void openPageModProba(View view){
        setContentView(R.layout.layout_mod_proba);
    }


    public void openPageInscription(View view){
        setContentView(R.layout.layout_inscription);
    }

    public void executeModule2(View view) throws Exception {
        Spinner spinnerAction = (Spinner) findViewById(R.id.spinnerAction);
        String action = spinnerAction.getSelectedItem().toString();

        Spinner spinnerMethode = (Spinner) findViewById(R.id.spinnerMethode);
        String methode = spinnerMethode.getSelectedItem().toString();

        System.out.println(action+ "  " +methode);


        EditText edkey = findViewById(R.id.editTextClef);
        EditText edmessage = findViewById(R.id.editTextMessage);
        String key = edkey.getText().toString();
        String message = edmessage.getText().toString();

        String res = "";

        try {
            if (methode.equals("RC4")){
                res = Module2RC4.RC4(action,key,message);
            }
            else{
                res = Module2WEP.WEP(action,key,message);
            }
        }
        catch (Exception e){
            res = "Erreur d'éxecution";
            e.printStackTrace();
        }


        TextView resultat = findViewById(R.id.textViewResultatModule2);
        resultat.setText(res);
    }


}
