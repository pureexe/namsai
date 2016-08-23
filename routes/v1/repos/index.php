<?php
$app->group('/repos', function () use ($app,$config,$pdo) {
    require('management/repoAdd.php');
    require('management/repoGet.php');
    require('management/repoRemove.php');
    require('management/privateGet.php');
    require('management/privateSet.php');
    require('management/privateUnset.php');
    require('management/descriptionGet.php');
    require('management/descriptionUpdate.php');
    require('management/contributorAdd.php');
    require('management/contributorGet.php');
    require('management/contributorRemove.php');
    require('core/nodeAdd.php');
    require('core/nodeUpdate.php');
    require('core/nodeRemove.php');
    require('core/nodeGet.php');
    require('core/storyAdd.php');
    require('core/storyRemove.php');
});


/*
-----------------
ส่วนจัดการทั่วไป
-----------------






// Fork,merge,issue,wiki ไม่มาเร็วๆนี้แน่นอน


----------------------
ส่วนจัดการ NLP
- cilent_secret (ยังไม่รองรับเร็วๆนี้)
----------------------
สนทนากับบอท
POST: /repos/:user/:repo/response
PARAMETER:
  - id (interactive's id)
  - input
RESPONSE:
  - message

ดึงค่าตัวแปร
GET: /repos/:user/:repo/variable/:type/:varName
PARAMETER:
  - id (interactive's id - require for type session and user)
RESPONSE
  - id (variable's id)
  - value

กำหนดค่าตัวแปร
POST: /repos/:user/:repo/variable/:type/:varName
PARAMETER:
  - access_token (optional for variable type app only)
  - id (interactive's id - require for type session and user)
  - value
RESPONSE
  - id (variable's id)

ลบตัวแปร
DELETE: /repos/:user/:repo/variable/:type/:varName
PARAMETER:
  - access_token (optional for variable type app only)
  - id (interactive's id - require for type session and user)
RESPONSE
  - id (variable's id)





รับเส้นเชื่อม
GET: /repos/:user/:repo/edge/:id
PARAMETER:
  - access_token (optional for private repo)
RESPONSE:
  - id (Edge id)
  - current
  - next

สร้างเส้นเชื่อมใหม่ระหว่าง 2 Node
POST /repos/:user/:repo/edge/
PARAMETER:
  - access_token
  - current (current node id)
  - next (node that point next)
RESPONSE
  - id (edge's id)

ลบเส้นเชื่อม
DELETE: /repos/:user/:repo/edge/:id
PARAMETER:
  - access_token (optional for private repo)
RESPONSE:
  - id (Edge id)

ร้บหัวข้อเรื่อง
GET: /repos/:user/:repo/story/:id
PARAMETER:
  - access_token (optional for private repo)
RESPONSE:
  - name

  */
?>
