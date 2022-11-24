import fonctions_integrales as fi

def rectangles_gauches(m, et, t,n):
    return fi.methode_rectangle_gauche(m, et, t,n)

print("rectangles gauches : " ,rectangles_gauches(3,5,2.5,1000000))