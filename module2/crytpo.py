import numpy as np


def KSA (cle) :
    
    longueur_cle = len(cle)
    S = list(range(256))
    j = 0
    for i in range (256):
        j = (j + S[i] + cle[i%longueur_cle]) % 256
        S[i], S[j] = S[j], S[i]
    return S




def PRGA (S,n) :
    i = 0
    j = 0 
    key=[]
    
    while n>0:
        n=n-1
        i = (i+1) % 256
        j = (j+S[i]) % 256
        S[i], S[j] = S[j], S[i]
        K = S[(S[i] + S[j]) %256]
        key.append(K)
        
    return key    

key = "KAREEM"
text = "Mission Accomplished"


def preparing_key_array(s) :
    return [ord(c) for c in s]

key = preparing_key_array(key)

S = KSA(key)

keystream = np.array(PRGA(S,len(text)))
print(keystream)

text = np.array([ord(i) for i in text])

cipher = keystream ^ text

print(cipher.astype(np.uint8).data.hex())
print( [chr(c) for c in cipher])