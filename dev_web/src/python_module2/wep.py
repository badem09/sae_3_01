from rc4 import *
from random import randint

def IV():
    """
    Génere une clé àléatoire (aussi appelée IV pour Initialization Vector) de 24 bits

    Entrée : None
    Retour : list : 3 entiers héxadécimaux (1 héxadécimal = 8 bit)
    """

    iv = randint(0,16777215) # 16777215 = FF FF FF
    nb = str(hex(iv)[2:]).upper() #éviter les '0x' 
    while len(nb) < 6:
        nb = "0" + nb
    nb = [nb[i:i+2] for i in range(0,len(nb),2)] #Regroupement par 2
    nb = [int('0x' + e,0) for e in nb] #convertion en décimal
    return nb

def WEP(action,key, message):
    """Chiffrement WEP basé sur l'algorithme RC4:
    Chiffre ou déchiffre un message selon une clé

    Entrée :
            action (str) : 'c' (chiffrement) ou 'd' (déchiffrement)
            key (str) : clé
            message (str) : message
        
    Sortie : (str)
            si chiffrement : Chaîne de caractère de nombres héxadécimaux
            si déchiffrement : Chaine de caractère contenant le message
    """
    

    if action == "c" : 
        message = [ord(c) for c in message] # valeur ascii des lettre du message
        iv = IV() # géneration de la clé aléatoire

    else :#Déchiffrement
        message = hexa_to_ten(message) # valeur décimale de la chaine de nombres héxadécimaux
        iv = message[:3] #clé aléatoire
        message = message[3:] #reste du message

    key = iv + [ord(c) for c in key] # concatenation 

    #Algorithme RC4
    # Initialiser la suite chiffrante
    suite = list(range(256))
    j = 0
    for i in range(256):
        j = (j + suite[i] + key[i % len(key)]) % 256
        suite[i], suite[j] = suite[j], suite[i]

    # Appliquer l'algorithme RC4 au message (cf PRGA(S) dans cours)
    result = []
    i = j = 0
    for lettre in message:
        i = (i + 1) % 256
        j = (j + suite[i]) % 256
        suite[i], suite[j] = suite[j], suite[i]
        result.append(lettre ^ suite[(suite[i] + suite[j]) % 256]) # ^ applique l'opérateur logique xor 

    if action == "c":
        return iv + result
    else : #si déchiffrement
        return ''.join([chr(e) for e in result])
        

if __name__ == '__main__':
    try:
        action = sys.argv[1]
        data = sys.argv[2]
        key = sys.argv[3]

        res = WEP(action,key,data)

        if action == "c":
            print(ten_to_hexa(res))
        else: 
            print(res)

    except:
        print("Le message ne possede pas le bon format")
