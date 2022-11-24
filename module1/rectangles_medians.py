import fonctions_integrales as fi
import sys

def rectangles_medians(m, et, t,n):
    return fi.methode_rectangle_medians(m, et, t,n)
    
#print(sys.argv)
# faire des tests pour que 
try:
    m = float(sys.argv[1])
    et = float(sys.argv[2])
    t = float(sys.argv[3])
    n = 1000000

    print(rectangles_medians(m,et,t,n))

except:
    print("L'une des valeurs rentrée n'est pas au bon format")



