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
    t = float(sys.argv[3])
    n = 1000000

    #print(round(rectangles_droite(m,et,t,n),5))
    # round : qd retour = 0.99900 ... retourne 0.999 po nice 
    #print(rectangles_droite(m,et,t,n))
    retour = str(rectangles_droite(m,et,t,n))
    #round
    #print(rectangles_medians(m,et,t,n))
    print(retour[:7])


except:
    print("L'une des valeurs rentrée n'est pas au bon format")



