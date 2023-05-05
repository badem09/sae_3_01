import unittest
import os
from importlib.machinery import SourceFileLoader

from dev_web.src.python_module2 import rc4 as rc4_relatif
from dev_web.src.python_module2 import wep as wep_relatif

curr_path = os.getcwd()
curr_path = curr_path.split("\\")[:-1]
curr_path.extend(["src","python_module2"])
curr_path = "\\".join(curr_path)


rc4_absolu = SourceFileLoader("rc4", curr_path + "\\rc4.py").load_module()
wep_absolu = SourceFileLoader("wep", curr_path + "\\wep.py").load_module()



class TestModule2(unittest.TestCase):

    ####################################### Integration Relatif RC4 #############################################################


    def test_IntegrationRelatif_ChiffrementRC4(self):
        with self.assertRaises(Exception):
            rc4_relatif.RC4(None,None,None)
            rc4_relatif.RC4("c", None, None)               # p1
            rc4_relatif.RC4("c", "cle" , None)            # p2
            rc4_relatif.RC4("c", None , "Message")            # p3

        self.assertIsNotNone(rc4_relatif.RC4("c", "Cle" , "Message"))   #p4

        #Tests fournis par le professeur:
        self.assertEqual(rc4_relatif.RC4('c','Key','Plaintext'),"BB F3 16 E8 D9 40 AF 0A D3")
        self.assertEqual(rc4_relatif.RC4('c','Wiki','pedia'),"10 21 BF 04 20")
        self.assertEqual(rc4_relatif.RC4('c','Secret','Attack at dawn'),"45 A0 1F 64 5F C3 5B 38 35 52 54 4B 9B F5")

    def test_IntegrationRelatif_DechiffrementRC4(self):
        with self.assertRaises(Exception):
            rc4_relatif.RC4("d", None, None)               # p1
            rc4_relatif.RC4("d", "cle" , None)            # p2
            rc4_relatif.RC4("d", None , "Message")            # p3
        self.assertIsNotNone(rc4_relatif.RC4("d", "Cle" , "D9 AF F4 DA 42 34 C2") )   #p4

        with self.assertRaises(Exception):
            rc4_relatif.RC4("d", 123 , "Message") #p5
            rc4_relatif.RC4("d", "Clé" , 123)     #P6

        # Tests fournis par le professeur:
        self.assertEqual(rc4_relatif.RC4('d', 'Key', 'BB F3 16 E8 D9 40 AF 0A D3'), "Plaintext")
        self.assertEqual(rc4_relatif.RC4('d', 'Wiki', '10 21 BF 04 20'), "pedia")
        self.assertEqual(rc4_relatif.RC4('d', 'Secret', '45 A0 1F 64 5F C3 5B 38 35 52 54 4B 9B F5'), "Attack at dawn")

    ####################################### Integration Absolue RC4 #############################################################


    def test_IntegrationAbsolue_ChiffrementRC4(self):

        with self.assertRaises(Exception):
            rc4_absolu.RC4(None,None,None)
            rc4_absolu.RC4("c", None, None)               # p1
            rc4_absolu.RC4("c", "cle" , None)            # p2
            rc4_absolu.RC4("c", None , "Message")            # p3

        self.assertIsNotNone(rc4_absolu.RC4("c", "Cle" , "Message"))   #p4

        #Tests fournis par le professeur:
        self.assertEqual(rc4_absolu.RC4('c','Key','Plaintext'),"BB F3 16 E8 D9 40 AF 0A D3")
        self.assertEqual(rc4_absolu.RC4('c','Wiki','pedia'),"10 21 BF 04 20")
        self.assertEqual(rc4_absolu.RC4('c','Secret','Attack at dawn'),"45 A0 1F 64 5F C3 5B 38 35 52 54 4B 9B F5")
    
     
    def test_IntegrationAbsolue_DechiffrementRC4(self):



        with self.assertRaises(Exception):
            rc4_absolu.RC4("d", None, None)               # p1
            rc4_absolu.RC4("d", "cle" , None)            # p2
            rc4_absolu.RC4("d", None , "Message")            # p3
        self.assertIsNotNone(rc4_absolu.RC4("d", "Cle" , "D9 AF F4 DA 42 34 C2") )   #p4

        with self.assertRaises(Exception):
            rc4_absolu.RC4("d", 123 , "Message") #p5
            rc4_absolu.RC4("d", "Clé" , 123)     #P6

        # Tests fournis par le professeur:
        self.assertEqual(rc4_absolu.RC4('d', 'Key', 'BB F3 16 E8 D9 40 AF 0A D3'), "Plaintext")
        self.assertEqual(rc4_absolu.RC4('d', 'Wiki', '10 21 BF 04 20'), "pedia")
        self.assertEqual(rc4_absolu.RC4('d', 'Secret', '45 A0 1F 64 5F C3 5B 38 35 52 54 4B 9B F5'), "Attack at dawn")
        

    ####################################### Integration Relatif WEP #############################################################

    def test_IntegrationRelatif_ChiffrementWEP(self):

        with self.assertRaises(Exception):
            wep_relatif.WEP("c", None, None)               # p1
            wep_relatif.WEP("c", "cle" , None)            # p2
            wep_relatif.WEP("c", None , "Message")            # p3

        self.assertIsNotNone(wep_relatif.WEP("c", "Cle" , "Message"))   #p4

        #A rajouter
        message_chiffre1 = wep_relatif.WEP('c','Key','Plaintext')
        message_chiffre2 = wep_relatif.WEP('c','Key','Plaintext')

        self.assertNotEqual(message_chiffre1, message_chiffre2)


    def test_IntegrationRelatif_DechiffrementWEP(self):

        with self.assertRaises(Exception):
            wep_relatif.WEP("d", None, None)               # p1
            wep_relatif.WEP("d", "cle" , None)            # p2
            wep_relatif.WEP("d", None , "Message")            # p3
        self.assertIsNotNone(wep_relatif.WEP("d", "Cle" , "D9 AF F4 DA 42 34 C2") )   #p4

        with self.assertRaises(Exception):
            wep_relatif.WEP("d", 123 , "Message") #p5
            wep_relatif.WEP("d", "Clé" , 123)     #P6

        message1 = wep_relatif.WEP('c', 'Key', 'Plaintext')
        message2 = wep_relatif.WEP('c', 'Wiki', 'pedia')
        message3 = wep_relatif.WEP('c', 'Secret', 'Attack at dawn')

        #A rajouter
        self.assertEqual(message1 ,wep_relatif.WEP('d','Key', message1))
        self.assertEqual(message1 ,wep_relatif.WEP('d','Wiki', message2))
        self.assertEqual(message1 ,wep_relatif.WEP('d','Secret', message3))


    ####################################### Integration Absolue WEP #############################################################

    def test_IntegrationAbsolue_ChiffrementWEP(self):

        with self.assertRaises(Exception):
            wep_absolu.WEP("c", None, None)               # p1
            wep_absolu.WEP("c", "cle" , None)            # p2
            wep_absolu.WEP("c", None , "Message")            # p3

        self.assertIsNotNone(wep_absolu.WEP("c", "Cle" , "Message"))   #p4

        #A rajouter
        message_chiffre1 = wep_absolu.WEP('c','Key','Plaintext')
        message_chiffre2 = wep_absolu.WEP('c','Key','Plaintext')

        self.assertNotEqual(message_chiffre1, message_chiffre2)
    
    def test_IntegrationAbsolue_DechiffrementWEP(self):

        with self.assertRaises(Exception):
            wep_absolu.WEP("d", None, None)               # p1
            wep_absolu.WEP("d", "cle" , None)            # p2
            wep_absolu.WEP("d", None , "Message")            # p3
        self.assertIsNotNone(wep_absolu.WEP("d", "Cle" , "D9 AF F4 DA 42 34 C2") )   #p4

        with self.assertRaises(Exception):
            wep_absolu.WEP("d", 123 , "Message") #p5
            wep_absolu.WEP("d", "Clé" , 123)     #P6

        message1 = wep_absolu.WEP('c', 'Key', 'Plaintext')
        message2 = wep_absolu.WEP('c', 'Wiki', 'pedia')
        message3 = wep_absolu.WEP('c', 'Secret', 'Attack at dawn')

        #A rajouter
        self.assertEqual("Plaintext" ,wep_absolu.WEP('d','Key', message1))
        self.assertEqual("pedia" ,wep_absolu.WEP('d','Wiki', message2))
        self.assertEqual("Attack at dawn" ,wep_absolu.WEP('d','Secret', message3))



if __name__ == '__main__':
    unittest.main()
