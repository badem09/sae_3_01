package com.example.app_sae_2;

import java.util.*;

public class Module2RC4 {

    public static String RC4(String action, String key, String message) throws Exception {
        if (!(key instanceof String)) {
            throw new Exception("Parameter 'key' must be str");
        }

        if (action.equals("c") && !(message instanceof String)) {
            throw new Exception("Parameter 'message' must be str");
        }

        List<Integer> keyList = new ArrayList<>();
        for (char c : key.toCharArray()) {
            keyList.add((int) c);
        }

        List<Integer> messageList;
        if (action.equals("c")) {
            messageList = new ArrayList<>();
            for (char c : message.toCharArray()) {
                messageList.add((int) c);
            }
        } else {
            messageList = hexaToTen(message);
        }

        // Initialiser la suite chiffrante (cf PRGA(S) dans le cours)
        List<Integer> suite = new ArrayList<>();
        for (int i = 0; i < 256; i++) {
            suite.add(i);
        }

        int j = 0;
        for (int i = 0; i < 256; i++) {
            j = (j + suite.get(i) + keyList.get(i % keyList.size())) % 256;
            Collections.swap(suite, i, j);
        }

        // Appliquer l'algorithme RC4 au message (cf KSA dans le cours)
        List<Integer> result = new ArrayList<>();
        int i = 0;
        j = 0;
        for (int lettre : messageList) {
            i = (i + 1) % 256;
            j = (j + suite.get(i)) % 256;
            Collections.swap(suite, i, j);
            result.add(lettre ^ suite.get((suite.get(i) + suite.get(j)) % 256));
        }

        if (action.equals("c")) {
            return tenToHexa(result);
        } else { // si déchiffrement
            StringBuilder stringBuilder = new StringBuilder();
            for (int e : result) {
                stringBuilder.append((char) e);
            }
            return stringBuilder.toString();
        }
    }

    public static String tenToHexa(List<Integer> liste) {
        StringBuilder stringBuilder = new StringBuilder();
        for (int e : liste) {
            String hexa = Integer.toHexString(e).toUpperCase();
            if (hexa.length() < 2) {
                hexa = "0" + hexa;
            }
            stringBuilder.append(hexa).append(" ");
        }
        return stringBuilder.toString().trim();
    }

    public static List<Integer> hexaToTen(String str) {
        str = str.replace(" ", "");
        List<Integer> liste = new ArrayList<>();
        for (int i = 0; i < str.length(); i += 2) {
            liste.add(Integer.parseInt(str.substring(i, i + 2), 16));
        }
        return liste;
    }
}
