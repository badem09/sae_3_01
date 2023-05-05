import unittest
from dev_web.src.python_module2 import rc4,wep

class TestModule2(unittest.TestCase):

    def testchiffrementRC4(self):
        """
        Test numéro 5
        """
        with self.assertRaises(Exception):
            rc4.RC4("c", None, None)               # p1
            rc4.RC4("c", "cle" , None)            # p2
            rc4.RC4("c", None , "Message")            # p3

        self.assertIsNotNone(rc4.RC4("c", "Cle" , "Message"))   #p4

        #Tests fournis par le professeur:
        self.assertEqual(rc4.RC4('c','Key','Plaintext'),"BB F3 16 E8 D9 40 AF 0A D3")
        self.assertEqual(rc4.RC4('c','Wiki','pedia'),"10 21 BF 04 20")
        self.assertEqual(rc4.RC4('c','Secret','Attack at dawn'),"45 A0 1F 64 5F C3 5B 38 35 52 54 4B 9B F5")

    def testdechiffrementRC4(self):
        """
        Test numéro 6
        """
        with self.assertRaises(Exception):
            rc4.RC4("d", None, None)               # p1
            rc4.RC4("d", "cle" , None)            # p2
            rc4.RC4("d", None , "Message")            # p3
        self.assertIsNotNone(rc4.RC4("d", "Cle" , "D9 AF F4 DA 42 34 C2") )   #p4

        with self.assertRaises(Exception):
            rc4.RC4("d", 123 , "Message") #p5
            rc4.RC4("d", "Clé" , 123)     #P6

        # Tests fournis par le professeur:
        self.assertEqual(rc4.RC4('d', 'Key', 'BB F3 16 E8 D9 40 AF 0A D3'), "Plaintext")
        self.assertEqual(rc4.RC4('d', 'Wiki', '10 21 BF 04 20'), "pedia")
        self.assertEqual(rc4.RC4('d', 'Secret', '45 A0 1F 64 5F C3 5B 38 35 52 54 4B 9B F5'), "Attack at dawn")

    def testchiffrementWEP(self):
        """
        Test numéro 7
        """
        with self.assertRaises(Exception):
            wep.WEP("c", None, None)               # p1
            wep.WEP("c", "cle" , None)            # p2
            wep.WEP("c", None , "Message")            # p3

        self.assertIsNotNone(wep.WEP("c", "Cle" , "Message"))   #p4

        #A rajouter
        message_chiffre1 = wep.WEP('c','Key','Plaintext')
        message_chiffre2 = wep.WEP('c','Key','Plaintext')

        self.assertNotEqual(message_chiffre1, message_chiffre2)

    def testdechiffrementWEP(self):
        """
        Test numéro 6
        """
        with self.assertRaises(Exception):
            wep.WEP("d", None, None)               # p1
            wep.WEP("d", "cle" , None)            # p2
            wep.WEP("d", None , "Message")            # p3
        self.assertIsNotNone(wep.WEP("d", "Cle" , "D9 AF F4 DA 42 34 C2") )   #p4

        with self.assertRaises(Exception):
            wep.WEP("d", 123 , "Message") #p5
            wep.WEP("d", "Clé" , 123)     #P6

        message1 = wep.WEP('c', 'Key', 'Plaintext')
        message2 = wep.WEP('c', 'Wiki', 'pedia')
        message3 = wep.WEP('c', 'Secret', 'Attack at dawn')

        #A rajouter
        self.assertEqual("Plaintext" ,wep.WEP('d','Key', message1))
        self.assertEqual("pedia" ,wep.WEP('d','Wiki', message2))
        self.assertEqual("Attack at dawn" ,wep.WEP('d','Secret', message3))

if __name__ == '__main__':
    unittest.main()