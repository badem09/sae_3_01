from math import * 

def loi_normale(x,esp,et):
    """
    Cours page 
    """
    denom = et * sqrt(2*pi)
    e = exp( (-1/2) * (( x-esp )/ et)**2   )
    res = (1/denom) * e

    return res



def methode_rectangle_gauche(esp,et,b):
    a = esp
    sum = 0
    n = ((b - a) ** 2 ) ** 0.5 
    for i in range(a,b):
        sum += loi_normale(i ,esp,et) #* i
    res = ((b - a) / n) * sum
    return res + 0.5

def methode_rectangle_droite(esp,et,b):
    a = esp
    sum = 0
    n = ((b - a) ** 2 ) ** 0.5 
    for i in range(a+1,b+1):
        sum += loi_normale(i ,esp,et) #* i
    res = ((b - a) / n) * sum
    return res + 0.5

def methode_rectangle_medians(esp,et,b):
    a = esp
    sum = 0
    n = ((b - a) ** 2 ) ** 0.5 
    for i in range(a,b):
        ni = (i + i+1) / 2
        sum+= loi_normale(ni,esp,et)
    res = ((b - a) / n) * sum
    return res + 0.5

def methode_trapeze(esp,et,b):
    a = esp
    sum = 0
    n = ((b - a) ** 2 ) ** 0.5 
    facteur = (b - a) / (2 * n)
    fa = loi_normale(a,esp,et)
    fb = loi_normale(b,esp,et)

    for i in range(a,b):
        sum += loi_normale(i-1 ,esp,et) #* i
    res = facteur * (fa + fb + 2*sum)
    return res + 0.5

def methode_Simpson(esp,et,b):
    a = esp
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

    return res + 0.5



print("rectangle gauche : " ,methode_rectangle_gauche(10,50,25))
print("rectangle droits : " , methode_rectangle_droite(10,50,25))
print("rectangle medians : " , methode_rectangle_medians(10,50,25))
print("trapèzes : " , methode_trapeze(10,50,25))
print("simpson : " , methode_Simpson(10,50,25))