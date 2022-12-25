import sys 

def RC4(action,cle, message):
    """
        Fonction permmetant de ...

        Paramètre:
            action (str) : Action à réaliser (chiffrement : c, dechiffrement : d)
            cle (str) : Clé chiffrante
            message (str) : texte à décrypter

        Return:
            Renvoi ...
        """
    keys = [ord(c) for c in cle]
    if action == "c" :                                                          # si chiffrement
        message = [ord(c) for c in message]
    else :                                                                      # si déchiffrement
        message = joli_hexa_to_ten(message)

    # Initialiser la suite chiffrante (cf KSA dans cours)
    suite = list(range(256))                                                    # cf ligne 3-4 algo cours
    j = 0
    for i in range(256):
        j = (j + suite[i] + keys[i % len(keys)]) % 256
        suite[i], suite[j] = suite[j], suite[i]                                 # permutation

    # Appliquer l'algorithme RC4 au message (cf PRGA(S) dans cours)
    result = []
    i = j = 0                                                                   # 2 pointeurs servant d'index
    for c in message:
        i = (i + 1) % 256                                                       # car 256 permutuations
        j = (j + suite[i]) % 256
        suite[i], suite[j] = suite[j], suite[i]                                 # permutation
        result.append(c ^ suite[(suite[i] + suite[j]) % 256])

    if action == "c":                                                           # si chiffrement
        return result
    else : 
        return ''.join([chr(e) for e in result])
        

def ten_to_joli_hexa(liste):
    """
        Fonction permmetant de transformer une liste d'entier (base 10) en joli hexadécimaux

        Paramètre :
            liste (List) : liste d'entier en base 10

        Return :
            Renvoi un joli hexadécimaux
    """
    liste = [hex(e)[2:].upper() if len(str(hex(e)))>3 else "0" + hex(e)[2:].upper() for e in liste]
    return " ".join(liste)

def joli_hexa_to_ten(str):
    """
        Fonction permmetant de transformer joli hexadécimaux en une liste d'entier (base 10)

        Paramètre :
            str (String) : liste d'entier en base 10

        Return :
            Renvoi une liste d'entier en base 10
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
    print("Le message ne possede pas le bon format")

