import unittest
import sys
sys.path.append("../agscraiping")
from agscraiping import scraiping

sut=scraiping
class Test(unittest.TestCase):
  def setUp(self):
      # 初期化処理
      pass

  def tearDown(self):
      # 終了処理
      pass

  def test_has_all_onair_info_true(self):
    expected=True
    test_dict={
      "begin":"",
      "end":"",
      "title":"",
      "personality":"",
    }
    actual=sut.has_all_onair_info(test_dict)
    self.assertEqual(expected,actual)

  def test_has_all_onair_info_false(self):
    expected=False
    test_dict={}
    actual=sut.has_all_onair_info(test_dict)
    self.assertEqual(expected,actual)

  def test_get_time(self):
    line='<h3 class="dailyProgram-itemHeaderTime">9:00 – 9:30</h3>'
    info={}
    sut.get_time(line, info)
    actual=info["begin"]=="900" and info["end"]=="930"
    expected=True
    self.assertEqual(expected,actual)

  def test_get_title(self):
    line='<a href="https://www.joqr.co.jp/qr/program/dekirukana/">明治  presents  花澤香菜のひとりでできるかな？</a>'
    info={}
    sut.get_title(line, info)
    actual=info["title"]
    expected="明治  presents  花澤香菜のひとりでできるかな？"
    self.assertEqual(expected,actual)

  def test_get_personality(self):
    line='<a href="https://www.joqr.co.jp/qr/personality/hanazawakana/">花澤香菜</a>'
    info={}
    sut.get_personality(line, info)
    actual=info["personality"][0]
    expected="花澤香菜"
    self.assertEqual(expected,actual)

  def test_get_personality_no_atag(self):
    line='	                            	                              光山心乃, 斉藤子虎	                            		                        </p>'
    info={}
    sut.get_personality(line, info)
    actual=info["personality"][1]
    expected="斉藤子虎"
    self.assertEqual(expected,actual)

if __name__=="__main__":
  unittest.main()