package com.example.app_sae_2;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;

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

}
