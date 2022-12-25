# source : https://gist.github.com/hsauers5/491f9dde975f1eaa97103427eda50071

def suite_chiffrante(key):                          #cf KSA dans cours
    """
    Fonction permmetant de générer la permutation S 

    Paramètre:
        key (str) : Clé chiffrante                  

    Return:
        chaine S (list[hexadecimale])
    """
    suite = [i for i in range(0, 256)]              # cf ligne 3-4 algo cours
    j = 0
    for i in range(0, 256):
        j = (j + suite[i] + key[i % len(key)]) % 256
        suite[i],suite[j] = suite[j],suite[i]       # on permute car
    return suite
    


def stream_generation(suite):                       #cf PRGA(S) dans cours
    """
    Fonction permmetant de générer la suite chiffrantes de RC4

    Paramètre:
        suite (list[hexadecimale]) : suite chiffrante

    Return:
        Génére un nombre pseudo aléatoire
    """
    i = 0                                           #2 pointeurs servant d'index
    j = 0
    while True:
        i = (i + 1) % 256                           #car 256 permutuations
        j = (j + suite[i]) % 256
        suite[j], suite[i] = suite[i],suite[j]      # on permute car

        yield suite[(suite[i] + suite[j]) % 256]    # = output   
                                                    # yield garde les valeurs de i et j d'un appel de cette fonction à un autre



def crypter(texte, key):
    """
    Fonction permmetant de crypter un mot selon le principe du RC4

    Paramètre:
        texte (str): texte à crypter
        key (str): clé permettant à crypter le texte

    Return:
        return le texte crypter ( hexadécimale(str) )
    """
    texte = [ord(lettre) for lettre in texte]
    key = [ord(lettre) for lettre in key]
    
    suite = suite_chiffrante(key)
    key_gen = stream_generation(suite)
    
    texte_cripte = ''
    for lettre in texte:
        base_16 = hex(lettre ^ next(key_gen))   # on transforme en hexadecimale la valeur du binaire en xor
        if base_16[0] == '-':                      # si base_16 est négatif: est de la forme -0x (forme indiquant forme hexadimale), donc prendre les 3 valeurs après
            crypte = str(base_16[3:]) + " " 
        else:
            crypte = str(base_16[2:]) + " "          # a ^ b = xor aux niveau des bits en base 2
        #print(list(crypte))
        if len(crypte) == 2:                         # si ya une lettre et un espace 
            crypte = '0' + crypte
        texte_cripte += (crypte.upper())             #transforme texte en MAJ
        
    return texte_cripte
    


def decrypt(texte_cripte, key):
    """
    Fonction permmetant de décrypter un mot selon le principe du RC4

    Paramètre:
        texte_cripte (str): texte à décrypter
        key (str): clé permettant à décrypter le texte

    Return:
        return le texte décrypter (str)
    """
    texte_cripte = texte_cripte.split(' ')
    texte_cripte = [int('0x' + cara , 0) for cara in texte_cripte]      # conversion en base 10
    key = [ord(lettre) for lettre in key]                               # ord() remplace toute lettre de la cle
                                                                        # par sa valeur unicode
    suite = suite_chiffrante(key)
    key_gen = stream_generation(suite)
    
    text_decripte = ''
    for lettre in texte_cripte:
        dec = str(chr(lettre ^ next(key_gen)))                       # chr() remplace unicode par lettre
        text_decripte += dec
    
    return text_decripte



if __name__ == '__main__':
    
    ed = input('Entrer E for Encrypt, or D for Decrypt: ').upper()
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
        

