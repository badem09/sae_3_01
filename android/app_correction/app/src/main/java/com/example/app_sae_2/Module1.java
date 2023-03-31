package com.example.app_sae_2;

public class Module1 {

    public static double loi_normale(double x, double m, double et) {
        double a = 1 / (et * Math.sqrt(2 * Math.PI));
        double b = Math.exp(-1 * Math.pow(x - m, 2) / (2 * Math.pow(et, 2)));
        return a * b;
    }

    public static double methode_rectangle_gauche(double m, double et, double t, int n) throws Exception {
        if (et < 0) {
            throw new Exception("Standard deviation must be positive");
        }

        double res;
        if (t < m) {
            res = Math.min(1 - methode_rectangle_gauche(t, et, m, n), 1);
        } else {
            double a = m;
            double b = t;
            double pas = (b - a) / n;
            if (a == b) {
                return 0.5;
            }
            double sum = 0;
            for (double i = a; i < b; i += pas) {
                sum += loi_normale(i, m, et);
            }
            res = sum * pas + 0.5;
        }
        return Math.max(Math.min(res, 1), 0);
    }

    public static double methode_rectangle_droite(double m, double et, double t, int n) throws Exception {
        if (et < 0) {
            throw new Exception("Standard deviation must be positive");
        }

        double res;
        if (t < m) {
            return Math.min(1 - methode_rectangle_droite(t, et, m, n), 1);
        } else {
            double a = m;
            double b = t;
            double pas = (b - a) / n;
            if (a == b) {
                return 0.5;
            }
            double sum = 0;
            for (double k = a + pas; k < b + pas; k += pas) {
                sum += loi_normale(k, m, et);
            }
            res = sum * pas + 0.5;
        }
        return Math.max(Math.min(res, 1), 0);
    }

    public static double methode_rectangle_medians(double m, double et, double t, int n) throws Exception {
        if (et < 0) {
            throw new Exception("Standard deviation must be positive");
        }

        double res;
        double sum = 0;
        double h = 0;
        if (t < m) {
            return Math.min(1 - methode_rectangle_medians(t, et, m, n), 1);
        } else {
            double a = m;
            double b = t;
            double pas = (b - a) / n;
            if (a == b) {
                return 0.5;
            }
            for (double k = a; k < b; k += pas) {
                double c = (k + k + pas) / 2;
                sum += loi_normale(c, m, et);
            }
            res = sum * pas + 0.5;
        }
        return Math.max(Math.min(res, 1), 0);
    }

    public static double methode_trapeze(double m, double et, double t, int n) {
    /*
    Calcul de l'intégrale correspondant à P(X<t) avec
    la méthode des trapèzes
    Entrées:
            m : éspérance (float / int)
            et : écart-type (float / int)
            t : variable (float / int)
            n : nombre de divisions/rectangles (int)
    Retour:
            Résultat (float)
    */
        if (et < 0) {
            throw new IllegalArgumentException("Standard deviation must be positive");
        }
        double sum = 0;
        double res = 0;
        if (t < m) {
            return Math.min(1 - methode_trapeze(t, et, m, n), 1);
        }
        else{
            double a = m;
            double b = t;
            double pas = (b - a) / n;
            double fa = loi_normale(a, m, et);
            double fb = loi_normale(b, m, et);
            if (a == b) {
                return 0.5;
            }
            for (double k = a + pas; k < b; k += pas) {
                sum += loi_normale(k, m, et);
            }
                res = ((b - a) / (2 * n) * (fa + fb + 2 * sum)) + 0.5;
            return Math.max(Math.min(res, 1), 0);
        }
    }


    public static double methode_simpson(double m, double et, double t, int n) {
    /*
    Calcul de l'intégrale correspondant à P(X<t) avec
    la méthode de Simpson
    Entrées:
            m : éspérance (float / int)
            et : écart-type (float / int)
            t : variable (float / int)
            n : nombre de divisions/rectangles (int)
    Retour:
            Résultat (float)
    */
        if (et < 0) {
            throw new IllegalArgumentException("Standard deviation must be positive");
        }

        double sum1 = 0;
        double sum2 = 0;
        double res = 0;
        if (t < m) {
            return Math.min(1 - methode_simpson(t, et, m, n), 1);
        }
        else{
            double a = m;
            double b = t;
            double fa = loi_normale(a, m, et);
            double fb = loi_normale(b, m, et);

            if (a == b) {
                return 0.5;
            }

            for (int k1 = 1; k1 < n; k1++) {
                double e1 = a + (k1 * (b - a)) / n;
                sum1 += loi_normale(e1, m, et);
            }

            for (int k2 = 0; k2 < n; k2++) {
                double e2 = a + ((2 * k2 + 1) * (b - a)) / (2 * n);
                sum2 += loi_normale(e2, m, et);
            }

            res = ((b - a) / (6 * n)) * (fa + fb + 2 * sum1 + 4 * sum2) + 0.5;
            return Math.max(Math.min(res, 1), 0);
        }
    }
}
