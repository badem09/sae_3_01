from math import *
from numpy import arange


def loi_normale(x, m, et):
    """
    Fonction de la loi normale telle que donnée en cours
    Entrées : 
            x : variable (float / int)
            m : éspérance (float / int)
            et : écart-type (float / int)
    Retour : res : f(x) (float / int)
    """
    denom = et * sqrt(2 * pi)
    e = exp((-1 / 2) * ((x - m) / et) ** 2)
    res = e / denom

    return res

def methode_rectangle_gauche(m, et, t,n):
    """ 
    Calcul de l'intégrale correspondant à P(X<t) avec 
    la méthode des rectangles gauches
    Entrées:
            m : éspérance (float / int)
            et : écart-type (float / int)
            t : variable (float / int)
            n : nombre de divisions/rectangles (int)
    Retour:
            Résultat (float)

    """
    sum = h = 0
    if t<m: # si t est "avant" m (P(t<X<m)), on calcule "l'inverse" (P(m<X<T))
        return 1 - methode_rectangle_gauche(t,et,m,n)
    
    a = m
    b = t
    pas = (b-a)/n #distance entre 2 division
    for a in arange(a,b,pas): # la somme 
        sum += loi_normale(a, m, et) 

    return sum*pas + 0.5 # +0.5 car P(X<t) = P(-inf<X<m) + P(m<X<t) et P(-inf<X<m)=0.5
    #Pour plus d'explications, voire le rapport.

def methode_rectangle_droite(m, et, t,n):
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
    sum = h = 0
    if t<m:
        return 1 - methode_rectangle_gauche(t,et,m,n)
    a = m
    b = t
    pas = (b-a)/n
    for k in arange(a+pas,b+pas,pas):
        sum += loi_normale(k, m, et) 
    return sum*pas + 0.5

def methode_rectangle_medians(m, et, t,n):
    """ 
    Calcul de l'intégrale correspondant à P(X<t) avec 
    la méthode des rectangles médians
    Entrées:
            m : éspérance (float / int)
            et : écart-type (float / int)
            t : variable (float / int)
            n : nombre de divisions/rectangles (int)
    Retour:
            Résultat (float)

    """
    sum = h = 0
    if t<m:
        return 1 - methode_rectangle_gauche(t,et,m,n)

    a = m
    b = t
    pas = (b-a)/n
    for k in arange(a, b, pas):
        c = (k+k+pas )/2
        h = loi_normale(c, m, et)  # * i
        sum+= h 
    return sum*pas + 0.5

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
    sum = h = 0
    if t<m:
        return 1 - methode_trapeze(t,et,m,n)
    a = m
    b = t
    pas = (b-a)/n
    fa = loi_normale(a,m,et)
    fb = loi_normale(b,m,et)

    for k in arange(a+pas, b, pas):
        sum+= loi_normale(k,m,et)
       
    return ((b-a) / (2*n) * (fa + fb + 2*sum)) + 0.5

def methode_simpson(m, et, t,n):
    """ 
    Calcul de l'intégrale correspondant à P(X<t) avec 
    la méthode de Simpson
    Entrées:
            m : éspérance (float / int)
            et : écart-type (float / int)
            t : variable (float / int)
            n : nombre de divisions/rectangles (int)
    Retour:
            Résultat (float)

    """
    sum1 = sum2 = 0
    if t<m:
        return 1 - methode_simpson(t,et,m,n)
    a = m
    b = t
    pas = (b-a)/ (2*n)
    fa = loi_normale(a,m,et)
    fb = loi_normale(b,m,et)

    #for k1 in arange(a+2*pas,b-2*pas,2*pas):# i pair
    for k1 in arange(a+1,n):# i pair
        e1 = (k1*(b-a)) / n
        e1 =+ a 
        sum1+= loi_normale(e1,m,et)

    #for k2 in arange(a+pas, b-2*pas, 2*pas):#i impair
    for k2 in arange(a, n):#i impair
        e2 = ((2*k2 +1) * (b-a)) / (2 * n)
        e2 =+ a
        sum2+= loi_normale(e2,m,et)

    return ((b-a)/(6*n)) * (fa + fb + 2*sum1 + 4*sum2) + 0.5


    
if __name__ == "__main__" :
    
    print("rectangle gauche : " ,methode_rectangle_gauche(1,5,2.5,1000000))
    print("rectangle droits : " , methode_rectangle_droite(1,5,2.5,1000000))
    print("rectangle medians : " , methode_rectangle_medians(1,5,2.5,1000000))
    print("rectangle trapeze2 : " , methode_trapeze(1,5,2.5,1000000))
    print("rectangle simpson2: " , methode_simpson(1,5,2.5,10000))
    
    print()

    print("rectangle gauche : " ,methode_rectangle_gauche(3,5,2.5,1000000))
    print("rectangle droits : " , methode_rectangle_droite(3,5,2.5,1000000))
    print("rectangle medians : " , methode_rectangle_medians(3,5,2.5,1000000))
    print("rectangle trapeze : " , methode_trapeze(3,5,2.5,1000000))
    print("rectangle simpson: " , methode_simpson(3,5,2.5,100))

    print()

    print("rectangle gauche : " ,methode_rectangle_gauche(4,2,3,1000000))
    print("rectangle droits : " , methode_rectangle_droite(4,2,3,1000000))
    print("rectangle medians : " , methode_rectangle_medians(4,2,3,1000000))
    print("rectangle trapeze : " , methode_trapeze(4,2,3,1000000))
    print("rectangle simpson: " , methode_simpson(4,2,3,10000))





