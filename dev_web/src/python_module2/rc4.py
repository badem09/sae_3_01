import sys 

def RC4(action,key, message):
    """Algorithme RC4 : Chiffre ou déchiffre un message selon une clé

    Entrée :
            action (str) : 'c' (chiffrement) ou 'd' (déchiffrement)
            key (str) : clé
            message (str) : message
        
    Sortie : (str)
            si chiffrement : Chaîne de caractère de nombres héxadécimaux
            si déchiffrement : Chaine de caractère contenant le message
    """
    
    key = [ord(c) for c in key] # valeur ascii des lettre de la clé
    if action == "c" : 
        message = [ord(c) for c in message] # valeur ascii des lettre du message
    else :
        message = joli_hexa_to_ten(message) # valeur décimale de la chaine de nombres héxadécimaux

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
        return result
    else : #si déchiffrement
        return ''.join([chr(e) for e in result])
        

def ten_to_joli_hexa(liste):
    """Convertit une liste de nombres décimaux (base 10) en 
    une chaîne de charactères de nombres héxadécimaux (base 16) 

    Entrée : 
            (list) : Nombres décimaux 
    Sortie :
            str (str) : Nombres héxadécimaux

    """    
    liste = [hex(e)[2:].upper() if len(str(hex(e)))>3 else "0" + hex(e)[2:].upper() for e in liste]
    return " ".join(liste)

def joli_hexa_to_ten(str):
    """Convertit une chaîne de charactères de nombres héxadéciamaux 
    (base 16) liste de nombres décimaux (base 10)

    Entrée : 
            str (str) : Nombres héxadécimaux

    Sortie :
            (list) : Nombres décimaux 
    """
    liste = str.split(" ")
    return [int('0x' + cara , 0) for cara in liste]

try:
    action = sys.argv[1]
    data = sys.argv[2]
    key = sys.argv[3]

    res = RC4(action,key,data)

    if action == "c":
        print(ten_to_joli_hexa(res))
    else: 
        print(res)

except:
    print("Erreur d'éxécution")

