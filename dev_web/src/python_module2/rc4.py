import sys 

def rc4(action,key, data):
    
    # Convertir la clé en un tableau d'entiers
    key_bytes = [ord(c) for c in key]
    if action == "c" : 
        data = [ord(c) for c in data]
    else :
        data = joli_hexa_to_ten(data)

    # Initialiser l'état de l'algorithme RC4
    state = list(range(256))
    j = 0
    for i in range(256):
        j = (j + state[i] + key_bytes[i % len(key_bytes)]) % 256
        state[i], state[j] = state[j], state[i]

    # Appliquer l'algorithme RC4 au message
    result = []
    i = j = 0
    for c in data:
        i = (i + 1) % 256
        j = (j + state[i]) % 256
        state[i], state[j] = state[j], state[i]
        result.append(c ^ state[(state[i] + state[j]) % 256])

    if action == "c":
    # Renvoyer le résultat
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

action = sys.argv[1]
data = sys.argv[2]
key = sys.argv[3]

res = rc4(action,key,data)

if action == "c":
    print(ten_to_joli_hexa(res))
else: 
    print(res)


"""encrypted_data = rc4("c",key, data)
decrypted_data = rc4("d",key, encrypted_data)

print(ten_to_joli_hexa(encrypted_data))
print(decrypted_data)  
"""
