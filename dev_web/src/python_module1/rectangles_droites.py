import fonctions_integrales as fi
import sys

def rectangles_droite(m, et, t,n):
    """ 
    Calcul de l'intégrale correspondant à P(X<t) avec 
    la méthode des rectangles droits
    Entrées:
            m : éspérance (float / int)
            et : écart-type (float / int)
            t : variable (float / int)
            n : nombre de divisions/rectangles (int)
    Retour:
            Résultat (float)

    """
    return fi.methode_rectangle_droite(m, et, t,n)
    
#print(sys.argv)
# faire des tests pour que 
try:
    m = float(sys.argv[1])
    et = float(sys.argv[2])
    t = sys.argv[3]
    n = 1000
    retour = str(rectangles_droite(m,et,float(t),n))
    print("P(X<" + t +  ") = " +  retour[:7])


except:
    print("L'une des valeurs rentrée n'est pas au bon format")



