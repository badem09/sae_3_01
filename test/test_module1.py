import unittest
from dev_web.src.python_module1.fonctions_integrales import *


class TestModule1(unittest.TestCase):

    def testMethodeRectangleGauche(self):
        assert methode_rectangle_gauche(1, 2, 3) > 0  # p1
        with self.assertRaises(Exception):
            methode_rectangle_gauche(1, -2, 3)  # p2
            methode_rectangle_gauche(1, -2, -3)  # p3
        assert methode_rectangle_gauche(1, 2, 3) > 0  # p4
        assert methode_rectangle_gauche(1, 2, 3) > 0  # p5
        with self.assertRaises(Exception):
            methode_rectangle_gauche(-1, -2, 3)  # p6
            methode_rectangle_gauche(-1, -2, -3)  # p7
        assert methode_rectangle_gauche(-1, 2, -3) > 0  # p8
        assert methode_rectangle_gauche(1, 2, 1) == 0.5  # p9

        print("Test Méthode rectangles gauches OK")

    def testMethodeRectangleDroit(self):
        assert methode_rectangle_droite(1, 2, 3) > 0  # p1
        with self.assertRaises(Exception):
            methode_rectangle_droite(1, -2, 3)  # p2
            methode_rectangle_droite(1, -2, -3)  # p3
        assert methode_rectangle_droite(1, 2, 3) > 0  # p4
        assert methode_rectangle_droite(1, 2, 3) > 0  # p5
        with self.assertRaises(Exception):
            methode_rectangle_droite(-1, -2, 3)  # p6
            methode_rectangle_droite(-1, -2, -3)  # p7
        assert methode_rectangle_droite(-1, 2, -3) > 0  # p8
        assert methode_rectangle_droite(1, 2, 1) == 0.5  # p9

        print("Test Méthode rectangles droits OK")

    def testMethodeRectangleMedians(self):
        assert methode_rectangle_medians(1, 2, 3) > 0  # p1
        with self.assertRaises(Exception):
            methode_rectangle_medians(1, -2, 3)  # p2
            methode_rectangle_medians(1, -2, -3)  # p3
        assert methode_rectangle_medians(1, 2, 3) > 0  # p4
        assert methode_rectangle_medians(1, 2, 3) > 0  # p5
        with self.assertRaises(Exception):
            methode_rectangle_medians(-1, -2, 3)  # p6
            methode_rectangle_medians(-1, -2, -3)  # p7
        assert methode_rectangle_medians(-1, 2, -3) > 0  # p8
        assert methode_rectangle_medians(1, 2, 1) == 0.5  # p9

        print("Test Méthode rectangles Médian OK")

    def testMethodeRectangleTrapeze(self):
        assert methode_trapeze(1, 2, 3) > 0  # p1
        with self.assertRaises(Exception):
            methode_trapeze(1, -2, 3)  # p2
            methode_trapeze(1, -2, -3)  # p3
        assert methode_trapeze(1, 2, 3) > 0  # p4
        assert methode_trapeze(1, 2, 3) > 0  # p5
        with self.assertRaises(Exception):
            methode_trapeze(-1, -2, 3)  # p6
            methode_trapeze(-1, -2, -3)  # p7
        assert methode_trapeze(-1, 2, -3) > 0  # p8
        assert methode_trapeze(1, 2, 1) == 0.5  # p9

        print("Test Méthode rectangles Trapézes OK")

    def testMethodeRectangleSimpson(self):
        assert methode_simpson(1, 2, 3) > 0  # p1
        with self.assertRaises(Exception):
            methode_simpson(1, -2, 3)  # p2
            methode_simpson(1, -2, -3)  # p3
        assert methode_simpson(1, 2, 3) > 0  # p4
        assert methode_simpson(1, 2, 3) > 0  # p5
        with self.assertRaises(Exception):
            methode_simpson(-1, -2, 3)  # p6
            methode_simpson(-1, -2, -3)  # p7
        assert methode_simpson(-1, 2, -3) > 0  # p8
        assert methode_simpson(1, 2, 1) == 0.5  # p9

        print("Test Méthode rectangles Simpson OK")


if __name__ == '__main__':
    unittest.main()
