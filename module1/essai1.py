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

def methode_rectangle_gauche(a,b,esp,et):
    sum = 0

    for i in range(a,b):
        sum += loi_normale(i-1 ,esp,et) #* i
    return  sum #n == ??


def methode_rectangle_droite(a,b,esp,et):
    sum = 0

    for i in range(a,b+1):
        sum += loi_normale(i-1 ,esp,et) #* i
    return  sum #n == ??

def methode_rectangle_medians(a,b,esp,et):
    sum = 0
    for i in range(a,b):
        ni = (i + i+1) / 2
        sum+= loi_normale(ni,esp,et)
    return sum

def methode_trapeze(a,b,esp,et):
    sum = 0
    facteur = (b - a) / (2 * (b-a))
    fa = loi_normale(a,esp,et)
    fb = loi_normale(b,esp,et)

    for i in range(a,b):
        sum += loi_normale(i-1 ,esp,et) #* i
    
    res = facteur * (fa + fb + 2*sum)
    return res

def methode_Simpson(a,b,esp,et):
    sum1 = 0
    sum2 = 0
    n = (b-a)
  
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

print("rectangle gauche : " ,methode_rectangle_gauche(0,25,10,50))
print("rectangle droits : " , methode_rectangle_droite(0,25,10,50))
print("rectangle medians : " , methode_rectangle_medians(0,25,10,50))
print("trapèzes : " , methode_trapeze(0,25,10,50))
print("simpson : " , methode_Simpson(0,25,10,50))

#Pour les tests :
#site reference : https://www.codabrainy.com/loi-normale/10/50/0/25/ 
