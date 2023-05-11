package com.example.app_sae_2;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

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

    //...
    public void openPageConnexion(View view){
        setContentView(R.layout.layout_connexion);
    }

    public void openPageChoixModule(View view){
        setContentView(R.layout.layout_choix_modules);
    }

    public void openPageModCrypto(View view){
        setContentView(R.layout.layout_mod_crypto);
    }

    public void openPageModProba(View view){
        setContentView(R.layout.layout_mod_proba);
    }


    public void openPageInscription(View view){
        setContentView(R.layout.layout_inscription);
    }

    public void executeModule2(View view){
        Spinner spinnerAction = findViewById(R.id.spinnerAction);
        String action = spinnerAction.getSelectedItem().toString();

        Spinner spinnerMethode = findViewById(R.id.spinnerMethode);
        String methode = spinnerMethode.getSelectedItem().toString();

        EditText edkey = findViewById(R.id.editTextClef);
        EditText edmessage = findViewById(R.id.editTextMessage);
        String key = edkey.getText().toString();
        String message = edmessage.getText().toString();
        String res;

        String choixDeBase = getResources().getStringArray(R.array.spinnerMethodeModule1)[0];
        if (key.equals("") || message.equals("") || methode.equals(choixDeBase)){
            Toast.makeText(getApplicationContext(), R.string.erreurChoixParametres, Toast.LENGTH_SHORT).show();
            return ;
        }

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

    public void executeModule1(View view){
        EditText edtT = findViewById(R.id.editTextT);
        EditText edtESP = findViewById(R.id.editTextESP);
        EditText edtET = findViewById(R.id.editTextET);
        TextView tvRes = findViewById(R.id.textViewResultatModule1);
        Spinner spinnerChoix = findViewById(R.id.spinnerMethodeModule1);
        String choix = spinnerChoix.getSelectedItem().toString();

        if (edtESP.getText().toString().equals("") || edtET.getText().toString().equals("") ||
                edtT.getText().toString().equals("")){
            Toast.makeText(getApplicationContext(), R.string.erreurChoixParametres, Toast.LENGTH_SHORT).show();
            tvRes.setText(R.string.erreur);
            return ;
        }

        try {
            double et = Float.parseFloat(edtET.getText().toString());
            double esp = Float.parseFloat(edtESP.getText().toString());
            double t = Float.parseFloat(edtT.getText().toString());
            double res = 0;
            String[] arrayMethode = getResources().getStringArray(R.array.spinnerMethodeModule1);
            int index = -1;
            for (int i = 0; i< arrayMethode.length; i++){
                if (choix.equals(arrayMethode[i])){
                    index = i;
                }
            }
            switch (index) {
                case 0 : // "Choisir Une méthode" :
                    Toast.makeText(getApplicationContext(), R.string.erreurChoixModule, Toast.LENGTH_SHORT).show();
                    tvRes.setText(R.string.erreur);
                    return ;
                case 1 : // "Rectangle Gauche":
                    res = Module1.methode_rectangle_gauche(esp, et, t, 1000);
                    break;
                case 2 : // "Rectangle Droit":
                    res = Module1.methode_rectangle_droite(esp, et, t, 1000);
                    break;
                case 3 : // "Rectangle Median":
                    res = Module1.methode_rectangle_medians(esp, et, t, 1000);
                    break;
                case 4 : // "Méthode des Trapèzes":
                    res = Module1.methode_trapeze(esp, et, t, 1000);
                    break;
                case 5  ://"Méthode de Simpsons":
                    res = Module1.methode_simpson(esp, et, t, 1000);
                    break;
            }
            tvRes.setText(String.valueOf(res));
        }
        catch (Exception e){
            e.printStackTrace();
            tvRes.setText(R.string.erreur);
        }
    }
}
