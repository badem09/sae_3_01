import crypto
import sys 


try :
    texte_cripte = sys.argv[1]
    key = sys.argv[2]
    print(crypto.decrypt(texte_cripte, key))


except  :
    print("Le message ne possede pas le bon format")