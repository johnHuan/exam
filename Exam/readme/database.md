#数据库说明：

##1. 数据表前缀: john_

##2. 各表的说明

   1. judgment： 判断题

|字段|说明|
|---|---|---|
|jid|主键|
|question|题干|
|answer|答案|
   2. selection： 选择题

|字段|说明|
|---|---|---|
|sid|主键|
|question|题干|
|answer|答案|
  3. selectionanswer： 选择题答案

|字段|说明|
|---|---|---|
|aid|主键|
|sid|对应关联选择题的主键|
|optionid|选项的表示符：A、B、C、D|
|optionTxt|选项的选项的内容|


 4. usererrorquestoinjudgment： 用户错题本--判断题

|字段|说明|
|---|---|---|
|id|主键|
|uid|对应关联用户的主键|
|jid|对应判断题的主键|

 5. usererrorquestoinselection： 用户错题本--选择题

|字段|说明|
|---|---|---|
|id|主键|
|uid|对应关联用户的主键|
|sid|对应选择题的主键|

 6. usererrorquestionjudgment： 用户收藏--判断题

|字段|说明|
|---|---|---|
|id|主键|
|uid|对应关联用户的主键|
|jid|对应判断题的主键|

 7. usererrorquestionselection： 用户收藏--选择题

|字段|说明|
|---|---|---|
|id|主键|
|uid|对应关联用户的主键|
|sid|对应选择题的主键|

8. ​user表， 考生表
|字段|说明|
|---|---|
|uid|主键|
|wechat|微信的openid|
|nickname|微信的昵称|
|exam_num|考生共申请的考试次数|
|p_sid|选择题练习到了第几题的id|
|p_jid|判断题练习到了第几题的id|
|state|该考生通过了几次考试|