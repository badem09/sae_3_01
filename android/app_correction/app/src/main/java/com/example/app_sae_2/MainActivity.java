package com.example.app_sae_2;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.graphics.Color;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {
    Button bt1;
    Button bt2;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        bt1 = findViewById(R.id.button);
        bt1.setOnClickListener(this::ActionBouton1);
    }


    //bouton pour aller page 2
    public void ActionBouton1(View view) { //module1 explication
        setContentView(R.layout.activity_main2);
        bt2 = findViewById(R.id.button2);
        Button bt3 = findViewById(R.id.button3);
        bt2.setOnClickListener(this::ModuleProba_Calcul);
        bt3.setOnClickListener(this::Mdoule2_Explication);

    }

    private void ModuleProba_Calcul(View view) {
        setContentView(R.layout.activity_main4);
        Button bt_module2  = findViewById(R.id.button3);
        bt_module2.setOnClickListener(this::Mdoule2_Explication);
    }

    //bouton essayer du module 1
    public void ActionBouton2(View view) {
    }
    //bouton pour aller page 3
    public void Mdoule2_Explication(View view) { //module2 explication
        setContentView(R.layout.activity_main3);
    }
    //bouton de la page 2 pr revenir page 1
    public void ActionBouton5(View view) {
        setContentView(R.layout.activity_main2);
    }
}
