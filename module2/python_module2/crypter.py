import crypto
import sys 


try :
    texte = sys.argv[1]
    key = sys.argv[2]

    print(crypto.crypter(texte, key))


except :
    print("Le message n'est pas au bon format")