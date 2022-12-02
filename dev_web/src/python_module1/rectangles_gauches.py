import fonctions_integrales as fi
import sys , platform, subprocess, traceback

def rectangles_gauches(m, et, t,n):
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
    return fi.methode_rectangle_gauche(m, et, t,n)



#try:
m = float(sys.argv[1])
et = float(sys.argv[2])
t = sys.argv[3]
n = 1000
retour = str(rectangles_gauches(m,et,float(t),n))
print("P(X<" + t +  ") = " +  retour[:9])
    


""" A tester sur le raspbery
except Exception as e :
    f = open("fichierErrors.txt","w")
    if platform.system().casefold() == 'Windows'.casefold():
        date = subprocess.getoutput("echo %date% %time%")
   
    elif platform.system().casefold() == 'Linux'.casefold():
        date = subprocess.getoutput("date")
    
    f.write(date + "\n\n" + traceback.format_exc() + "\n" + str(sys.argv))

    f.close()"""




