# source : https://gist.github.com/hsauers5/491f9dde975f1eaa97103427eda50071

def suite_chiffrante(key):
    """
    Pseudo Random Generation Algorithm
    """
    suite = [i for i in range(0, 256)]
    j = 0
    for i in range(0, 256):
        j = (j + suite[i] + key[i % len(key)]) % 256
        suite[i],suite[j] = suite[j],suite[i]
    return suite
    

def stream_generation(suite):
    """
    Pseudo Random Stream
    """
    i = 0
    j = 0
    while True:
        i = (1 + i) % 256
        j = (suite[i] + j) % 256
        suite[j], suite[i] = suite[i],suite[j]    

        yield suite[(suite[i] + suite[j]) % 256] # = output   
        #yield garde les valeurs de i et j d'un appel de cette fonction 
        #à un autre


def crypter(text, key):
    text = [ord(lettre) for lettre in text]
    key = [ord(lettre) for lettre in key]
    
    suite = suite_chiffrante(key)
    key_stream = stream_generation(suite)
    
    texte_cripte = ''
    for lettre in text:
        base_16 = hex(lettre ^ next(key_stream))
        if base_16[0] == '-':
            cryp = str(base_16[3:]) + " " # si base_16 est négatif: à un moins devant
        else:
            cryp = str(base_16[2:]) + " "
        # a ^ b = xor aux niveau des bits en bases 2
        print(list(cryp))
        if len(cryp) == 2: # si ya une lettre et un espace 
            cryp = '0' + cryp
        texte_cripte += (cryp.upper())
        
    return texte_cripte
    

def decrypt(texte_cripte, key):
    texte_cripte = texte_cripte.split(' ')
    texte_cripte = [int('0x' + cara , 0) for cara in texte_cripte] # conversion en base 10
    key = [ord(lettre) for lettre in key] # ord() remplace cada lettre de la cle
                                          # par sa valeur unicode
    suite = suite_chiffrante(key)
    key_stream = stream_generation(suite)
    
    text_decripte = ''
    for lettre in texte_cripte:
        dec = str(chr(lettre ^ next(key_stream))) # chr() remplace unicode par lettre
        text_decripte += dec
    
    return text_decripte


if __name__ == '__main__':
    
    ed = input('Enter E for Encrypt, or D for Decrypt: ').upper()
    if ed == 'E':
        plaintext = input('Enter your plaintext: ')
        key = input('Enter your secret key: ')
        result = crypter(plaintext, key)
        print('Result: ')
        print(result)
    elif ed == 'D': 
        ciphertext = input('Enter your ciphertext: ')
        key = input('Enter your secret key: ')
        result = decrypt(ciphertext, key)
        print('Result: ')
        print(result)
    else:
        print('Error in input - try again.')
        