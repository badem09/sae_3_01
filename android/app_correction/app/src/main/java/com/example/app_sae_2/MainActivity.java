package com.example.app_sae_2;

import androidx.appcompat.app.AppCompatActivity;

import android.content.res.Resources;
import android.content.res.TypedArray;
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

    public void executeModule1(View view) throws Exception {
        EditText edtT = findViewById(R.id.editTextT);
        EditText edtESP = findViewById(R.id.editTextESP);
        EditText edtET = findViewById(R.id.editTextET);
        TextView tvRes = findViewById(R.id.textViewResultatModule1);

        try {

            double et = Integer.parseInt(edtET.getText().toString());
            double esp = Integer.parseInt(edtESP.getText().toString());
            double t = Integer.parseInt(edtT.getText().toString());

            Spinner spinnerChoix = findViewById(R.id.spinnerMethodeModule1);
            String choix = spinnerChoix.getSelectedItem().toString();

            double res = 0;
            System.out.println(choix);
            switch (choix) {
                case "Choisir Une méthode" : throw new Exception();
                case "Rectangle Gauche":
                    res = Module1.methode_rectangle_gauche(esp, et, t, 1000);
                case "Rectangle Droit":
                    res = Module1.methode_rectangle_droite(esp, et, t, 1000);
                case "Rectangle Median":
                    res = Module1.methode_rectangle_medians(esp, et, t, 1000);
                case "Méthode des Trapèzes":
                    res = Module1.methode_trapeze(esp, et, t, 1000);
                case "Méthode de Simpsons":
                    res = Module1.methode_simpson(esp, et, t, 1000);
            }
            tvRes.setText(String.valueOf(res));
        }
        catch (Exception e){
            e.printStackTrace();
            tvRes.setText("Erreur");
        }
    }



}
