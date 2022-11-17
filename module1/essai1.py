from math import * 
from sympy import *


def esperance(n,p):
    """
    x : liste des valeurs 
    p : liste des probabilités de x 
    """
    sum=0
    for i in range (len(x)):
        sum += n[i] * p[i]
    return sum

def variance(n,p):
    n_copy = n.copy()
    for i in range(len(n)):
        n_copy[i] = n_copy[i] **2
    m = esperance(n_copy,p) - esperance(n,p)**2

    return m


def ecart_type(n,p):
    return variance(n,p)**0.5


def loi_normale(x,esp,et):
    """
    Cours page 
    """
    denom = et * sqrt(2*pi)
    e = exp( (-1/2) * (( x-esp )/ et)**2   )
    res = (1/denom) * e

    return res

def methode_rectangle_gauche(esp,et,b,a=0):
    sum = 0
    n = ((b - a) ** 2 ) ** 0.5 
    for i in range(a,b):
        sum += loi_normale(i-1 ,esp,et) #* i
    return  ((b - a) / n) * sum #n == ??


def methode_rectangle_droite(esp,et,b,a=0):
    sum = 0
    n = ((b - a) ** 2 ) ** 0.5 
    for i in range(a,b+1):
        sum += loi_normale(i-1 ,esp,et) #* i
    return  ((b - a) / n) * sum #n == ??

def methode_rectangle_medians(esp,et,b,a=0):
    sum = 0
    n = ((b - a) ** 2 ) ** 0.5 
    for i in range(a,b):
        ni = (i + i+1) / 2
        sum+= loi_normale(ni,esp,et)
    return ((b - a) / n) * sum

def methode_trapeze(esp,et,b,a=0):
    sum = 0
    n = ((b - a) ** 2 ) ** 0.5 
    facteur = (b - a) / (2 * n)
    fa = loi_normale(a,esp,et)
    fb = loi_normale(b,esp,et)

    for i in range(a,b):
        sum += loi_normale(i-1 ,esp,et) #* i
    
    res = facteur * (fa + fb + 2*sum)
    return res

def methode_Simpson(esp,et,b,a=0):
    sum1 = 0
    sum2 = 0
    n = ((b - a) ** 2 ) ** 0.5 
  
    facteur = (b - a) / (6 * n)
    fa = loi_normale(a,esp,et)
    fb = loi_normale(b,esp,et)

    for k in range(a,b):
        sum1 += loi_normale(a +  ((k * n) /n),esp,et) # sans les n?

    for k in range(a,b):
        sum2 += loi_normale(((2*k + 1) * n)/(2*n) ,esp,et) # sans les n?

    res = facteur * (fa + fb + 2*sum1 + 4*sum2)

    return res
    



x = [0,10,20]
p = [1/4, 1/2, 1/4]

#print(esperance(x,p))
#print(loi_normale(15, esperance(x,p), ecart_type(x,p)))

"""print("rectangle gauche : " ,methode_rectangle_gauche(10,50,25))
print("rectangle droits : " , methode_rectangle_droite(10,50,25))
print("rectangle medians : " , methode_rectangle_medians(10,50,25))
print("trapèzes : " , methode_trapeze(10,50,25))
print("simpson : " , methode_Simpson(10,50,25))"""

#Pour les tests :
#site reference : https://www.codabrainy.com/loi-normale/10/50/0/25/ 



## Ce que je peux faire c'est je regarde manuellement ou la courbe
## devient asymptote (coté négatif) et je considère que c'est min 
## donc que de min à -inf ya que des 0 (algo de recherche dichotomie?)

# si = 0.9999999999999991 =1



## Chercher la solution en 0 de la dérivé de la loi normale fait buger 
## les sorties changent et ne sont plus cohérentes

#esp= Symbol('esp')
#et= Symbol('et')
#print(diff(loi_normale(x,10,50))) # dérivé
#an = Symbol('an')
#equation = loi_normale(x,50,10)
#y = Symbol('y')
#print(solve(diff(loi_normale(y,10,50))))
"""
x= Symbol('x')
f= 1/  (2 * pi)**0.5 * exp(-(x**2)/2 )
print(integrate(f,(x,-inf,2)))"""

#print("rectangle gauche : " ,methode_rectangle_gauche(1,1,2,-100000))

def f(x):
   return 1/  (2 * pi)**0.5 * exp(-(x**2)/2 )

from matplotlib.pyplot import plot, show, legend
x= Symbol('x')
ab = [ i for i in range(-10,10) ]
ord = [ f(a) for a in range(-10,10) ]
plot(ab,ord,color='orange')
show()
