import sys 

def RC4(action,key, message):
    
    key_bytes = [ord(c) for c in key]
    if action == "c" : 
        message = [ord(c) for c in message]
    else :
        message = joli_hexa_to_ten(message)

    # Initialiser la suite chiffrante
    suite = list(range(256))
    j = 0
    for i in range(256):
        j = (j + suite[i] + key_bytes[i % len(key_bytes)]) % 256
        suite[i], suite[j] = suite[j], suite[i]

    # Appliquer l'algorithme RC4 au message (cf PRGA(S) dans cours)
    result = []
    i = j = 0
    for c in message:
        i = (i + 1) % 256
        j = (j + suite[i]) % 256
        suite[i], suite[j] = suite[j], suite[i]
        result.append(c ^ suite[(suite[i] + suite[j]) % 256])

    if action == "c":
        return result
    else : 
        return ''.join([chr(e) for e in result])
        

def ten_to_joli_hexa(liste):
    """Prend une liste d'entier base décimale et le transforme en joli hexadécimaux"""
    liste = [hex(e)[2:].upper() if len(str(hex(e)))>3 else "0" + hex(e)[2:].upper() for e in liste]
    return " ".join(liste)

def joli_hexa_to_ten(str):
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

