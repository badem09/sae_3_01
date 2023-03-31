package com.example.app_sae_2;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;

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
}
