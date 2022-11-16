from math import * 


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

def methode_rectangles(a,b,esp,et):
    sum = 0

    for i in range(a,b+1):
        sum += loi_normale(i-1 ,esp,et) * i
    return (b-a) / n * sum #n == ??


x = [0,10,20]
p = [1/4, 1/2, 1/4]

print(esperance(x,p))
print(loi_normale(15, esperance(x,p), ecart_type(x,p)))

print(methode_rectangles(0,15,10,50))