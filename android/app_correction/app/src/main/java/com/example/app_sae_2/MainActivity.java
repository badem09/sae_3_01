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

<<<<<<< HEAD
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
=======

    //bouton pour aller page 2
    public void ActionBouton1(View view) { //module1 explication
        setContentView(R.layout.activity_main2);
        bt2 = findViewById(R.id.button2);
        bt3 = findViewById(R.id.button3);
        bt2.setOnClickListener(this::ModuleProba_Calcul);
        bt3.setOnClickListener(this::Mdoule2_Explication);

    }

    private void ModuleProba_Calcul(View view) {
        setContentView(R.layout.activity_main4);
        Button bt_module2  = findViewById(R.id.button3);
        bt_module2.setOnClickListener(this::Mdoule2_Explication);
    }


    //bouton pour aller page 3
    @SuppressLint("MissingInflatedId")
    public void Mdoule2_Explication(View view) { //module2 explication
        setContentView(R.layout.activity_main3);
        Button bt_module2Calcul = findViewById(R.id.button_calcul);
        bt_module2Calcul.setOnClickListener(this::ModuleCrypto2_1Calcul);
        Button bt_changementpage = findViewById(R.id.button3);
        bt_changementpage.setOnClickListener(this::ActionBouton5);
    }

    private void ModuleCrypto2_1Calcul(View view) {
        setContentView(R.layout.page_calcul_module2_1);
    }

    //bouton de la page 2 pr revenir page 1
    public void ActionBouton5(View view) {
        setContentView(R.layout.activity_main2);
>>>>>>> 6b3a0500676664e36237b3be454885cbfb227d9e
    }
}
