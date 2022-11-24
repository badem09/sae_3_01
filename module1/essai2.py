from math import *
from numpy import arange


def loi_normale(x, esp, et):
    """
    Cours page 
    """
    denom = et * sqrt(2 * pi)
    e = exp((-1 / 2) * ((x - esp) / et) ** 2)
    res = e / denom

    return res


print(loi_normale(1.23, 0, 1))


def methode_rectangle_gauche(esp, et, b):
    a = esp
    sum = h = 0
    n = ((b - a) ** 2) ** 0.5
    nb_decimales= 5 #on divise par 10**-5
    if esp<b<0 or b>esp>0:
        for i in arange(a, b, 10**(-nb_decimales)):
            i = round(i,nb_decimales)
            h = loi_normale(i, esp, et)  # * i
            l = ((i - (i-10**(-nb_decimales))) / n)
            sum+= h * l
        return sum + 0.5
    else:
        return 1 - methode_rectangle_gauche(b,et,esp)


def methode_rectangle_droite(esp, et, b):
    # et toujours > 0
    a = esp
    sum = h = 0
    n = ((b - a) ** 2) ** 0.5
    nb_decimales= 5 #on divise par 10**-5
    if esp < b < 0 or b > esp > 0:
        for i in arange(a+10**(-nb_decimales), b+10**(-nb_decimales), 10**(-nb_decimales)):
            i = round(i,nb_decimales)
            h = loi_normale(i , esp, et)  # * i
            l = ((i - (i - 10 ** (-nb_decimales))) / n)
            sum += h * l
           # if res > 0.5:
           #     res = 0.5
        return sum + 0.5
    else:
        return 1 - methode_rectangle_droite(b, et, esp)


def methode_rectangle_medians(esp, et, b):
    a = esp
    sum = 0
    n = ((b - a) ** 2) ** 0.5
    nb_decimales= 5 #on divise par 10**-5

    if esp < b < 0 or b > esp > 0:
        for i in arange(a, b, 10**(-nb_decimales)):
            i = round(i,nb_decimales)
            c = (i + i + 10**(-nb_decimales))/2
            h = loi_normale(c, esp, et)  # * i
            l = ((i - (i-10**(-nb_decimales))) / n)
            sum+= h * l
        #if res > 0.5:
            #res = 0.5
        return sum + 0.5

    if b < esp < 0 or esp > b > 0:  # cas 2 et 4
        return 1 - methode_rectangle_gauche(b,et,esp)


def methode_trapeze(esp, et, b):
    a = esp
    sum = 0
    n = ((b - a) ** 2) ** 0.5
    facteur = (b - a) / (2 * n)

    nb_decimales= 5 #on divise par 10**-5

    if esp < b < 0 or b > esp > 0:
        for i in arange(a, b, 10**(-nb_decimales)):
            h1 = loi_normale(i + 10**(-nb_decimales), esp, et)  # * i
            h2 = loi_normale(i, esp, et)  # * i
            #l = i + 10**(-nb_decimales) - i
            l = 10**(-nb_decimales)
            if h1>h2:
                aire = l * h1 - ((h1-h2) * l)/2
            if h1<h2:
                aire = l * h2 - ((h2-h1) * l)/2
            sum+=aire
        #if res > 0.5:
        #    res = 0.5
        return sum + 0.5
    if b < esp < 0 or esp > b > 0:  # cas 2 et 4
        return 1 - methode_rectangle_gauche(b,et,esp)


def methode_Simpson(esp, et, b):
    a = esp
    sum = 0
    n = ((b - a) ** 2) ** 0.5

    nb_decimales= 5 #on divise par 10**-5

    if esp < b < 0 or b > esp > 0:
        for i in arange(a, b, 10 ** (-nb_decimales)):
            i = round(i, nb_decimales)
            milieu = ( (i+10 ** (-nb_decimales)) - i )/2  # h
            res = milieu/3 * (loi_normale(i , esp, et) + 4*(loi_normale(milieu , esp, et)
                        + loi_normale(i + i+10** (-nb_decimales) , esp, et)))
            sum += res
        #if res > 0.5:
        #    res = 0.5
        return sum + 0.5
    if b < esp < 0 or esp > b > 0:  # cas 2 et 4
        return 1 - methode_rectangle_gauche(b,et,esp)


print("rectangle gauche : " ,methode_rectangle_gauche(1,5,2.5))
print("rectangle droits : " , methode_rectangle_droite(1,5,2.5))
print("rectangle medians : " , methode_rectangle_medians(1,5,2.5))
print("trapèzes : " , methode_trapeze(1,5,2.5))
print("simpson : " , methode_Simpson(1,5,2.5))
#0.6179114222
#seul trapeze good on this example

print("rectangle gauche cas 1 : ", methode_rectangle_gauche(2, 3, 3))
print("rectangle droits cas 1 : " , methode_rectangle_droite(2,3,3))
print("rectangle medians cas 1 : " , methode_rectangle_medians(2,3,3))
print("rectangle trapèzes cas 1 : " , methode_trapeze(2,3,3))
print("rectangle simpson cas 1 : " , methode_Simpson(2,3,3))

"""
print("rectangle gauche cas 2 : " , methode_rectangle_gauche(2,3,3))
print("rectangle gauche cas 3 : " , methode_rectangle_gauche(-2,3,-1))
print("rectangle gauche cas 4 : " , methode_rectangle_gauche(-1,3,-2))
print(" ")

print("rectangle droits cas 2 : " , methode_rectangle_droite(2,3,3))
print("rectangle droits cas 3 : " , methode_rectangle_droite(-2,3,-1))
print("rectangle droits cas 4 : " , methode_rectangle_droite(-1,3,-2))

print("rectangle trapèzes cas 2 : " , methode_trapeze(2,3,3))
print("rectangle trapèzes cas 3 : " , methode_trapeze(-2,3,-1))
print("rectangle trapèzes cas 4 : " , methode_trapeze(-1,3,-2))
print(" ")

print("rectangle medians cas 2 : " , methode_rectangle_medians(2,3,3))
print("rectangle medians cas 3 : " , methode_rectangle_medians(-2,3,-1))
print("rectangle medians cas 4 : " , methode_rectangle_medians(-1,3,-2))

print("rectangle simpson cas 1 : " , methode_Simpson(3,3,2))
print("rectangle simpson cas 2 : " , methode_Simpson(2,3,3))
print("rectangle simpson cas 3 : " , methode_Simpson(-2,3,-1))
print("rectangle simpson cas 4 : " , methode_Simpson(-1,3,-2))
"""