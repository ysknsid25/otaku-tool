import unittest
import sys
sys.path.append("../util")
from util import sendmail

sut=sendmail
class Test(unittest.TestCase):
  def setUp(self):
      # 初期化処理
      pass

  def tearDown(self):
      # 終了処理
      pass

  def test_sendmail(self):
    expected=202
    notify_info={
    "to":"kengo071225@gmail.com",
    "fr":"you@youremail.com",
    "frnm":"送信者名",
    "sub":"タイトル",
    "text":"familyname さんは何をしていますか？\r\n 彼はplaceにいます。",
    "html":'<strong>familyname さん</strong>'
    }
    actual=sut.sendMail(notify_info)
    self.assertEqual(expected,actual)

if __name__=="__main__":
  unittest.main()