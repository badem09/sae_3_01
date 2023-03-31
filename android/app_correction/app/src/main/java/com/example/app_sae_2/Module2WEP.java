package com.example.app_sae_2;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Random;
import java.util.stream.Collectors;
import java.util.stream.Stream;


public class Module2WEP {

    public static List<Integer> IV() {
        /**
         * Génere une clé àléatoire (aussi appelée IV pour Initialization Vector) de 3 octets (24 bits)
         * et les retournes sous forme décimale.
         * Entrée : None
         * Retour : List<Integer> : 3 entiers décimaux sui sont la conversion de chaque octet
         * EX ; IV = 16000000 ; IV = F42400 (base 16)
         * retour = [F4 , 24 , 00] -> [244 , 36, 00]
         */

        Random random = new Random();
        int iv = random.nextInt(16777216); // Génére un entier aléatoire entre 0 et 16777215 (FF FF FF)
        String nb = Integer.toHexString(iv).toUpperCase(); // convertion de l'entier en hexadécimal puis en string pour
                                                            // supprimer les '0x'
        while (nb.length() < 6) { // remplissage de 0 : si iv = FF, donne 0000FF
            nb = "0" + nb;
        }
        List<Integer> result = new ArrayList<>();
        for (int i = 0; i < nb.length(); i += 2) { // Regroupement par 2 (par octet)
            result.add(Integer.parseInt(nb.substring(i, i + 2), 16)); // convertion de chaque octet en décimal
        }
        return result;
    }
    public static String WEP(String action, String key, String message) {
        List<Integer> result = new ArrayList<>();
        List<Integer> keyBytes = new ArrayList<>();
        List<Integer> iv = new ArrayList<>();
        int j = 0;

        if (action.equals("c")) { // Chiffrement
            for (int i = 0; i < message.length(); i++) {
                char c = message.charAt(i);
                result.add((int) c);
            }
            iv = IV(); // clé aléatoire
        } else { // Déchiffrement
            List<Integer> decimalMessage = Module2RC4.hexaToTen(message); // valeur décimale de la chaine de nombres héxadécimaux
            iv = decimalMessage.subList(0, 3); // clé aléatoire
            result = decimalMessage.subList(3, decimalMessage.size()); // reste du message
        }

        for (int i = 0; i < key.length(); i++) {
            char c = key.charAt(i);
            keyBytes.add((int) c);
        }

        keyBytes.addAll(0, iv); // Concatenation IV et clé

        // Algorithme RC4
        // Initialiser la suite chiffrante (cf KSA dans le cours)
        List<Integer> suite = new ArrayList<>();
        for (int i = 0; i < 256; i++) {
            suite.add(i);
        }

        for (int i = 0; i < 256; i++) {
            j = (j + suite.get(i) + keyBytes.get(i % keyBytes.size())) % 256;
            Collections.swap(suite, i, j);
        }

        // Appliquer l'algorithme RC4 au message (cf PRGA(S) dans le cours)
        List<Integer> xorList = new ArrayList<>();
        int i = 0;
        j = 0;
        for (int lettre : result) {
            i = (i + 1) % 256;
            j = (j + suite.get(i)) % 256;
            Collections.swap(suite, i, j);
            xorList.add(lettre ^ suite.get((suite.get(i) + suite.get(j)) % 256)); // ^ applique l'opérateur logique xor
        }

        if (action.equals("c")) {
            List<Integer> list = null;
            if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.N) {
                list = Stream.concat(iv.stream(), xorList.stream()).collect(Collectors.toList());
            }
            return Module2RC4.tenToHexa(list); // Concatenation IV (3 bits) et message chiffré
        } else { // si déchiffrement
            String resultString = "";
            for (int e : xorList) {
                resultString += (char) e;
            }
            return resultString;
        }
    }
}



