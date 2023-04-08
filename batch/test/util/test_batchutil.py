import unittest
import sys
sys.path.append("../util")
from util import batchutil

sut=batchutil
class Test(unittest.TestCase):
    def setUp(self):
        # 初期化処理
        pass

    def tearDown(self):
        # 終了処理
        pass

    def test_is_replace_colon(self):
        exp="1000"
        act=sut.replace_time_to_str("10:00")
        self.assertEqual(exp,act)

    def test_is_replace_None_to_strtime(self):
        exp=""
        act=sut.fomat_int_time_to_str(None)
        self.assertEqual(exp,act)

    def test_is_replace_under_100_to_strtime(self):
        exp=""
        act=sut.fomat_int_time_to_str(0)
        self.assertEqual(exp,act)

    def test_is_replace_under_900_to_strtime(self):
        exp="09:00"
        act=sut.fomat_int_time_to_str(900)
        self.assertEqual(exp,act)

    def test_is_replace_over_1000_to_strtime(self):
        exp="10:00"
        act=sut.fomat_int_time_to_str(1000)
        self.assertEqual(exp,act)

if __name__=="__main__":
    unittest.main()