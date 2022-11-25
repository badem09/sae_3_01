import fonctions_integrales as fi
import sys


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

#print(sys.argv)
# faire des tests pour que 
try:
    m = float(sys.argv[1])
    et = float(sys.argv[2])
    t = float(sys.argv[3])
    n = 1000000

    print(methode_trapeze(m,et,t,n))

except:
    print("L'une des valeurs rentrée n'est pas au bon format")

