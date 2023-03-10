import fonctions_integrales as fi
import sys, decimal as d


def methode_trapeze(m, et, t,n):
    """ 
    Calcul de l'intégrale correspondant à P(X<t) avec 
    la méthode des trapèzes
    Entrées:
            m : éspérance (float / int)
            et : écart-type (float / int)
            t : variable (float / int)
            n : nombre de divisions/rectangles (int)
    Retour:
            Résultat (float)

    """
    return fi.methode_trapeze(m, et, t,n)

m = float(sys.argv[1])
et = float(sys.argv[2])
t = sys.argv[3]
n = 1000
retour = str(d.Decimal(methode_trapeze(m,et,float(t),n)))
if retour == '0.00000':
    retour + str(0)
print("P(X<" + t +  ") = " +  retour[:7])
